<?php 

 $apiKey = '0eHNm9PvaACqrbi3NpUqauH7DUukByLBMsp9CeFMPidht';
 $endPoint = 'https://api.mnotify.com/api/sms/quick';
 //$apiKey = 'YOUR_API_KEY';
 $url = $endPoint . '?key=' . $apiKey;
 $data = [
    'recipient' => ['0546747672', '0208512258'],
    'sender' => 'PROJECT2020',
    'message' => 'API messaging is fun!',
    'is_schedule' => 'true',
    'schedule_date' => '2020-04-30 13:17'
 ];

 $ch = curl_init();
 $headers = array();
 $headers[] = "Content-Type: application/json";
 curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
 curl_setopt($ch, CURLOPT_URL, $url);
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
 curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
 curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
 $result = curl_exec($ch);
 $result = json_decode($result, TRUE);
 print_r($result);
 curl_close($ch);

?>