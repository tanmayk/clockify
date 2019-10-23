<?php

namespace Clockify\Clockify;

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
  public function __construct(string $apiKey) {
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
  private function setApiKey(string $apiKey) {
    $this->apiKey = $apiKey;
  }

  /**
   * Gets the API key.
   */
  public function getApiKey() {
    return $this->apiKey;
  }

  /**
   * Sends API request & returns the response.
   */
  public function apiRequest($endpoint, $type = 'GET', $data = array()) {

  }

}
