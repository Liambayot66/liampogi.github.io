<?php
class firebaseRDB {
    private $url = "";

    function __construct($url) {
        $this->url = rtrim($url, '/') . '/';
    }

    private function request($url, $method, $data = null) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        if ($data) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
        }
        $response = curl_exec($ch);
        curl_close($ch);
        return json_decode($response, true);
    }

    public function retrieve($path) {
        return $this->request($this->url . $path . ".json", "GET");
    }

    public function insert($path, $data) {
        return $this->request($this->url . $path . ".json", "POST", $data);
    }

    public function update($path, $data) {
        return $this->request($this->url . $path . ".json", "PATCH", $data);
    }

    public function delete($path) {
        return $this->request($this->url . $path . ".json", "DELETE");
    }
}
?>
