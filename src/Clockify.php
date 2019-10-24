<?php

namespace Clockify;

use GuzzleHttp\Client;

/**
 * Clockify class.
 */
class Clockify {

  /**
   * API base endpoint URL.
   */
  const API_BASE_ENDPOINT = 'https://api.clockify.me/api/v1/';

  /**
   * API key.
   *
   * @var string
   */
  protected $apiKey;

  /**
   * Contructs the Clockify object.
   */
  public function __construct($apiKey) {
    if (empty($apiKey)) {
      throw new Exception('Missing API key.');
    }
    else {
      $this->setApiKey($apiKey);
    }
  }

  /**
   * Sets the API key.
   *
   * @var string
   */
  private function setApiKey($apiKey) {
    $this->apiKey = $apiKey;
  }

  /**
   * Gets the API key.
   */
  public function getApiKey() {
    return $this->apiKey;
  }

  /**
   * Gets default headers.
   */
  public function defaultHeaders() {
    return array(
      'X-Api-Key' => $this->getApiKey(),
    );
  }

  /**
   * Sends API request & returns the response.
   */
  public function apiRequest($endpoint, $type = 'GET', $data = array(), $headers = array()) {
    // Prepare endpoint url.
    $url = self::API_BASE_ENDPOINT . $endpoint;
    // Get default headers.
    $headers = $headers + $this->defaultHeaders();
    $client = new Client();
    // Prepare options.
    $options = array();
    // Add headers.
    $options['headers'] = $headers;
    try {
      $response = $client->request($type, $url, $options);
    }
    catch (Exception $e) {
      $response = $e->getResponse();
    }
    // Prepare response structure.
    return $this->prepareResponse($response);
  }

  /**
   * Prepares response structure.
   */
  public function prepareResponse($response) {
    $body = $response->getBody();
    $response_data = array(
      'status' => $response->getStatusCode(),
      'body' => json_decode($body, TRUE),
    );
    return $response_data;
  }

}
