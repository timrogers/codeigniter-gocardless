<?php

/**
 * GoCardless merchant functions
 *
 */

/**
 * GoCardless merchant class
 *
 */
class GoCardless_Merchant {

  public static $endpoint = '/merchants';

  function __construct($client, $attrs) {

    $this->client = $client;

    foreach ($attrs as $key => $value) {
      $this->$key = $value;
    }

  }

  /**
   * Fetch a merchant from the API
   *
   * @param string $id The id of the merchant to fetch
   *
   * @return object The merchant object
   */
  public static function find($id) {

    $endpoint = self::$endpoint . '/' . $id;

    return new self(GoCardless::$client, GoCardless::$client->apiGet($endpoint));

  }

  /**
   * Fetch a bill item from the API
   *
   * @param string $id The id of the bill to fetch
   *
   * @return object The bill object
   */
  public static function findWithClient($client, $id) {

    $endpoint = self::$endpoint . '/' . $id;

    return new self($client, $client->apiGet($endpoint));

  }

  /**
   * Fetch a merchant's subscriptions from the API
   *
   * @param string $id The id of the merchant's subscriptions to fetch
   *
   * @return array Array of subscription objects
   */
  public function subscriptions() {

    $objects = array();

    $endpoint = self::$endpoint . '/' . $this->id . '/subscriptions';

    foreach ($this->client->apiGet($endpoint) as $value) {
      $objects[] = new GoCardless_Subscriptions($this->client, $value);
    }

    return $objects;

  }

  /**
   * Fetch a merchant's pre-authorisations from the API
   *
   * @param string $id The id of the merchant's pre-authorisations to fetch
   *
   * @return array Array of pre-authorisation objects
   */
  public function pre_authorizations() {

    $endpoint = self::$endpoint . '/' . $this->id . '/pre_authorizations';

    $objects = array();

    foreach ($this->client->apiGet($endpoint) as $value) {
      $objects[] = new GoCardless_PreAuthorization($this->client, $value);
    }

    return $objects;

  }

  /**
   * Fetch a list of the users associated with a given merchant
   *
   * @param string $id The id of the merchant's users to fetch
   *
   * @return array Array of user objects
   */
  public function users() {

    $endpoint = self::$endpoint . '/' . $this->id . '/users';

    $objects = array();

    foreach (GoCardless::$client->apiGet($endpoint) as $value) {
      $objects[] = new GoCardless_Users($this->client, $value);
    }

    return $objects;

  }

  /**
   * Fetch a merchant's bills from the API
   *
   * @param string $id The id of the merchant's bills to fetch
   *
   * @return array Array of bill objects
   */
  public function bills() {

    $endpoint = self::$endpoint . '/' . $this->id . '/bills';

    $objects = array();

    foreach ($this->client->apiGet($endpoint) as $value) {
      $objects[] = new GoCardless_Bills($this->client, $value);
    }

    return $objects;

  }

  /**
   * Fetch a merchant's payments from the API
   *
   * @param string $id The id of the merchant's payments to fetch
   *
   * @return array Array of payment objects
   */
  public function payments() {

    $endpoint = self::$endpoint . '/' . $this->id . '/payments';

    $objects = array();

    foreach ($this->client->apiGet($endpoint) as $value) {
      $objects[] = new GoCardless_Payments($this->client, $value);
    }

    return $objects;

  }

}

?>