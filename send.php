<?php
// send.php
header('Content-Type: application/json');

$token = '8999336095:AAEqUbvG5vHss1GnOQBpf6sLyIpMRCHRytw';
$chat_id = '6612073142';

$name = $_POST['name'] ?? 'Гость';
$status = $_POST['status'] ?? 'Не указано';

$message = "📋 НОВЫЙ ОТВЕТ RSVP\n\n👤 Имя: $name\n📌 Статус: $status\n💒 Свадьба: Нурхамидали & Бурулай\n🕐 Время: " . date('d.m.Y H:i:s');

$url = "https://api.telegram.org/bot$token/sendMessage";
$data = [
    'chat_id' => $chat_id,
    'text' => $message,
    'parse_mode' => 'HTML'
];

$options = [
    'http' => [
        'header' => "Content-type: application/x-www-form-urlencoded\r\n",
        'method' => 'POST',
        'content' => http_build_query($data)
    ]
];

$context = stream_context_create($options);
$result = file_get_contents($url, false, $context);

if ($result === false) {
    echo json_encode(['success' => false, 'error' => 'Ошибка отправки']);
} else {
    echo json_encode(['success' => true, 'result' => json_decode($result)]);
}
?>