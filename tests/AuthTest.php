<?php
/**
 * [Short description for file]
 *
 * [Long description for file (if any)...]
 *
 * @category   EuropeTrack 2.0
 * @package    EuropeTrack 2.0
 * @author     Jasper Algra <jasper@yarp-bv.nl>
 * @copyright  (C)Copyright 2016 YARP B.V.
 * @version    CVS: $Id:$
 * @since      22-12-2016 / 09:34
 */
use PHPUnit\Framework\TestCase;

class AuthTest extends TestCase {


    public function testInit()
    {
        $client = new nusoap_client('http://www.xignite.com/xquotes.asmx?WSDL', 'wsdl');
    }

    /**
     *
     *
     */
    public function testWsdlClient1()
    {
        $proxyhost = isset($_POST['proxyhost']) ? $_POST['proxyhost'] : '';
        $proxyport = isset($_POST['proxyport']) ? $_POST['proxyport'] : '';
        $proxyusername = isset($_POST['proxyusername']) ? $_POST['proxyusername'] : '';
        $proxypassword = isset($_POST['proxypassword']) ? $_POST['proxypassword'] : '';
        $client = new nusoap_client('http://www.xignite.com/xquotes.asmx?WSDL', 'wsdl',
            $proxyhost, $proxyport, $proxyusername, $proxypassword);
        $err = $client->getError();
        if ($err) {
            echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
        }
        // Doc/lit parameters get wrapped
        $param = array('Symbol' => 'IBM');
        $result = $client->call('GetQuickQuotes', array('parameters' => $param), '', '', false, true);
        // Check for a fault
        if ($client->fault) {
            echo '<h2>Fault</h2><pre>';
            print_r($result);
            echo '</pre>';
        } else {
            // Check for errors
            $err = $client->getError();
            if ($err) {
                // Display the error
                echo '<h2>Error</h2><pre>' . $err . '</pre>';
            } else {
                // Display the result
                echo '<h2>Result</h2><pre>';
                print_r($result);
                echo '</pre>';
            }
        }
        echo '<h2>Request</h2><pre>' . htmlspecialchars($client->request, ENT_QUOTES) . '</pre>';
        echo '<h2>Response</h2><pre>' . htmlspecialchars($client->response, ENT_QUOTES) . '</pre>';
        echo '<h2>Debug</h2><pre>' . htmlspecialchars($client->debug_str, ENT_QUOTES) . '</pre>';


    }

    /**
     */
    public function testGetTerminalDetails()
    {

    }
}