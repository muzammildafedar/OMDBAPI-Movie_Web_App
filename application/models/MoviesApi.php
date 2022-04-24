<?php                                                                                   

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @description : Library to access MyOperator Public API
 */
Class MoviesApi extends CI_Model {

    protected $developers_url = 'http://www.omdbapi.com/?apikey=';
    protected $apiKey = '483570a3';


    public function main() {
        # request for Logs
        $url_thor = $this->developers_url.$this->apiKey.'&&s=thor';
        $url_fury = $this->developers_url.$this->apiKey.'&&s=furry';
        $url_iron = $this->developers_url.$this->apiKey.'&&s=iron';
        $result_thor = $this->_post_api($url_thor);
        $result_fury = $this->_post_api($url_fury);
        $result_iron = $this->_post_api($url_iron);


        // $this->log("result");
        // $this->log($result_thor);
        // $this->log($result_fury);
        // $this->log($result_iron);
        $result = array(json_decode($result_thor), json_decode($result_fury), json_decode($result_iron)); 
        // $this->log($result);
        return json_encode($result); 
    }
    public function searchByid($id){
        // echo "adss";
        $url = $this->developers_url.$this->apiKey.'&&i='.$id;
        $result = $this->_post_api($url);
        // $this->log($url);
        // $this->log($result);

        return json_decode($result);



    }
    public function searchBytitle($title){
        // echo "adss";
        $url = $this->developers_url.$this->apiKey.'&&s='.$title;
        $result = $this->_post_api($url);
        // $this->log($url);
        // $this->log($result);

        return json_decode($result);



    }
    


    private function _post_api($url) {
        try {

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Length: 0'));
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_TIMEOUT, 30);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
            $result = curl_exec($ch);
            // print_r($result);
        } catch (Exception $e) {
            return false;
        }
       
        curl_close($ch);
        if ($result)
            // print_r(json_decode($result));
            return $result;
        else
            return false;
    }

    private function log($message) {
        print_r($message);
        echo "\n";
    }

}

?>
