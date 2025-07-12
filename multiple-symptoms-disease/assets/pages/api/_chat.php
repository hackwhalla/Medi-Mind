<?php
session_start();
header('Content-Type: application/json');

// ✅ CONFIG
$apiKey = "AIzaSyCDn3c2o0biaYqyG--8JDrdaBmrH5kyXfU"; // Replace with your actual API key
$url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key=$apiKey";

// ✅ INCLUDE DB
include '../_db.php'; // Adjust if needed

// ✅ GET EMAIL FROM SESSION
$userEmail = $_SESSION['user_email'] ?? 'unknown@example.com';

// ✅ GET USER SYMPTOMS MESSAGE
if (!isset($_POST['message']) || trim($_POST['message']) === '') {
    echo json_encode(['reply' => 'Please enter your symptoms.']);
    exit;
}
$user_msg = trim($_POST['message']);

// ✅ CREATE DYNAMIC PROMPT USING USER SYMPTOMS
$prompt = <<<TEXT
 Provide only the names of desease these conditions.

My Feelings & Symptoms: ($user_msg)

Based on this information, please provide a list of possible diseases or conditions I might be experiencing.Answer with disease names only.
TEXT;

// ✅ INIT CHAT HISTORY
if (!isset($_SESSION['chat_history'])) {
    $_SESSION['chat_history'] = [
        [
            "role" => "user",
            "parts" => [["text" => "cdr"]]
        ],
        [
            "role" => "model",
            "parts" => [["text" => "Understood. I will respond in user's language, in short and simple sentences without any intro."]]
        ]
    ];
}

// ✅ APPEND USER PROMPT TO CHAT HISTORY
$_SESSION['chat_history'][] = [
    "role" => "user",
    "parts" => [["text" => $prompt]]
];
$history = $_SESSION['chat_history'];

// ✅ SEND API REQUEST
$payload = json_encode(["contents" => $history]);

$ch = curl_init($url);
curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => $payload,
    CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
]);
$response = curl_exec($ch);
curl_close($ch);

$responseData = json_decode($response, true);
$ai_msg = $responseData['candidates'][0]['content']['parts'][0]['text'] ?? 'Sorry, no response.';

// ✅ CLEAN AI RESPONSE
$ai_msg = str_replace('*', '', $ai_msg);
$ai_msg = preg_replace('/^(I understand.?|As an AI.?)[\.\n]+/i', '', $ai_msg);
$ai_msg = trim($ai_msg);

// ✅ SAVE TO DATABASE
try {
    $stmt = $conn->prepare("INSERT INTO patient (user_email, user_message, ai_response) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $userEmail, $user_msg, $ai_msg);
    $stmt->execute();
    $stmt->close();
} catch (Exception $e) {
    error_log("DB Error: " . $e->getMessage());
}

// ✅ RETURN RESPONSE
echo json_encode(['reply' => $ai_msg]);