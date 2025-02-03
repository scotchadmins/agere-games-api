# Agere Gaming API Documentation

## Stage Game API Documentation

### Overview
This document provides detailed API information for interacting with the Agere Gaming platform, including examples of requests, responses, and usage of PHP cURL for integrating the provided endpoints.

---

### Step 1: Fetch Game Providers

#### API Endpoint
**URL**:
`https://staging.agere.games/api/games/admin/getAllCombineAPI?action=get_providers&token=<TOKEN>&casino=<CASINO>&isEnabled=true`

**Method**: `GET`

**Description**: Retrieves a list of game providers, including provider IDs, names, logos, and other metadata.

#### Input Parameters
| Parameter     | Type     | Required | Description                                                              |
|---------------|----------|----------|--------------------------------------------------------------------------|
| `action`      | `string` | Yes      | Specifies the action. Use `get_providers` for this request.             |
| `token`       | `string` | Yes      | The authentication token to access the API.                             |
| `casino`      | `string` | Yes      | A unique casino identifier.                                             |
| `isEnabled`   | `boolean`| Yes      | Indicates if only enabled providers should be fetched (`true`) or all.  |

#### Sample Response
```json
{
  "status": 200,
  "data": [
    {
      "id": 7,
      "name": "Urgent Games",
      "logoURL": "https://urgent.games/_Marketing/_LogoUrgentGames/Urgent%20Games%20Logo%20White.png",
      "providerID": "1",
      "iconURL": null,
      "bannerURL": null,
      "key": "UrgentGames"
    }
  ]
}
```

#### Response Fields
| Field          | Type      | Description                                                             |
|----------------|-----------|-------------------------------------------------------------------------|
| `status`       | `integer` | The HTTP status code of the response.                                  |
| `data`         | `array`   | Contains details of game providers.                                    |
| `data.id`      | `integer` | Unique identifier for the provider.                                    |
| `data.name`    | `string`  | The name of the game provider.                                         |
| `data.logoURL` | `string`  | URL of the provider's logo.                                            |
| `data.providerID` | `string`| Internal identifier for the provider.                                  |
| `data.iconURL` | `string`  | URL of the provider's icon (nullable).                                 |
| `data.bannerURL` | `string`| URL of the provider's banner (nullable).                               |
| `data.key`     | `string`  | Unique key representing the provider.                                  |

#### PHP cURL Example
```php
<?php
$curl = curl_init();

curl_setopt_array($curl, [
    CURLOPT_URL => "https://staging.agere.games/api/games/admin/getAllCombineAPI?action=get_providers&token=<TOKEN>&casino=<CASINO>&isEnabled=true",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_CUSTOMREQUEST => "GET",
]);

$response = curl_exec($curl);

if (curl_errno($curl)) {
    echo "cURL Error: " . curl_error($curl);
} else {
    echo $response;
}

curl_close($curl);
```

---

### Step 2: Fetch Available Games

#### API Endpoint
**URL**:
`https://staging.agere.games/games/admin/getAllCombineAPI?action=available_games&token=<TOKEN>&casino=<CASINO>&page=<PAGE>&gameType=<GAME_TYPE>&provider=<PROVIDER_ID>`

**Method**: `GET`

**Description**: Retrieves a list of available games for a specific provider and game type.

#### Input Parameters
| Parameter     | Type     | Required | Description                                                           |
|---------------|----------|----------|-----------------------------------------------------------------------|
| `action`      | `string` | Yes      | Specifies the action. Use `available_games` for this request.         |
| `token`       | `string` | Yes      | The authentication token to access the API.                          |
| `casino`      | `string` | Yes      | A unique casino identifier.                                          |
| `page`        | `integer`| Yes      | Specifies the page number for paginated results.                     |
| `gameType`    | `string` | Yes      | The type of games to filter by (e.g., `LiveGames`).                  |
| `provider`    | `string` | Yes      | The ID of the game provider obtained from Step 1.                    |

#### Sample Response
```json
{
  "providers": [
    {
      "id": "444",
      "sortOrder": 1000,
      "disabledByCasino": false,
      "providerId": "444",
      "name": "Slot City",
      "logoURL": null,
      "gamesCount": 163,
      "aggregator": null,
      "iconURL": "",
      "bannerURL": ""
    }
  ],
  "gamesTypes": [
    {
      "name": "LiveGames",
      "gamesCount": 164
    }
  ],
  "availableGames": {
    "games": [
      {
        "name": "Bonsai Speed Baccarat B",
        "gameType": "LiveGames",
        "category": "LiveGames",
        "id": "1728898460218",
        "providerId": "444",
        "providerName": "Slot City",
        "gameIcon": "https://contents.static-slotcity.com/game_pic/evo/baccarat.png",
        "serverUrl": "https://staging.agere.games/providers/slot-city-991325451/",
        "isDemo": true,
        "disabledByCasino": false
      }
    ]
  }
}
```

#### PHP cURL Example
```php
<?php
$providerId = "1"; // Replace with the provider ID obtained from Step 1
$page = 1;
$gameType = "LiveGames";

$curl = curl_init();

$url = "https://staging.agere.games/games/admin/getAllCombineAPI?action=available_games&token=<TOKEN>&casino=<CASINO>&page=$page&gameType=$gameType&provider=$providerId";

curl_setopt_array($curl, [
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_CUSTOMREQUEST => "GET",
]);

$response = curl_exec($curl);

if (curl_errno($curl)) {
    echo "cURL Error: " . curl_error($curl);
} else {
    echo $response;
}

curl_close($curl);
```

---

### Step 3: Get Game URL

#### API Endpoint
**URL**:
`https://staging.agere.games/providers/fresh-deck-754163245/?action=gameLoad&token=<TOKEN>&casino=<CASINO>&game_id=<GAME_ID>&currency=USD&language=en&mode=online&redirectUrl=<REDIRECT_URL>&depositUrl=<DEPOSIT_URL>&remote_id=<REMOTE_ID>`

**Method**: `GET`

**Description**: Retrieves the playable game URL for a specific game ID, including configuration parameters like currency, language, and redirect URLs.

#### Input Parameters
| Parameter     | Type     | Required | Description                                                            |
|---------------|----------|----------|------------------------------------------------------------------------|
| `action`      | `string` | Yes      | Specifies the action. Use `gameLoad` for this request.                |
| `token`       | `string` | Yes      | The authentication token to access the API.                           |
| `casino`      | `string` | Yes      | A unique casino identifier.                                           |
| `game_id`     | `string` | Yes      | The unique ID of the game to be loaded.                               |
| `currency`    | `string` | Yes      | Currency code for the game session (e.g., `USD`).                     |
| `language`    | `string` | No       | Language code for the game interface.                                 |
| `mode`        | `string` | Yes      | Specifies the game mode (e.g., `online`).                             |
| `redirectUrl` | `string` | No       | URL to redirect the user after the game session ends.                 |
| `depositUrl`  | `string` | No       | URL for depositing funds.                                             |
| `remote_id`   | `string` | Yes      | Remote identifier for the game session.                               |

#### Sample Response
```json
{
  "status": 200,
  "result": "https://tables.freshdeckstudios.com/?serverid=5165168&token=fbfafdb22412805eb07106d2a2cb",
  "token": "fbfafdb22412805eb07106d2a2cb"
}
```

#### PHP cURL Example
```php
<?php
$gameId = "1729233221935";
$remoteId = "1737536028598";
$redirectUrl = "http://localhost:3000/games/fresh-deck";
$depositUrl = "http://localhost:3000/my-account/deposit";

$curl = curl_init();

$url = "https://staging.agere.games/providers/fresh-deck-754163245/?action=gameLoad&token=<TOKEN>&casino=<CASINO>&game_id=$gameId&currency=USD&language=en&mode=online&redirectUrl=$redirectUrl&depositUrl=$depositUrl&remote_id=$remoteId";

curl_setopt_array($curl, [
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_CUSTOMREQUEST => "GET",
]);

$response = curl_exec($curl);

if (curl_errno($curl)) {
    echo "cURL Error: " . curl_error($curl);
} else {
    echo $response;
}

curl_close($curl);
```
---
### User Registration API

#### API Endpoint

**URL**:
`https://staging.agere.games/api/players/register`

**Method**: `POST`

**Description**: This API registers a new user in the system.

#### Input Parameters

| Parameter  | Type     | Required | Description                                  |
| ---------- | -------- | -------- | -------------------------------------------- |
| `token`    | `string` | Yes      | Authentication token.                        |
| `casino`   | `string` | Yes      | Unique casino identifier.                    |
| `remoteId` | `string` | Yes      | Unique user identifier.                      |
| `currency` | `string` | Yes      | Currency code (e.g., `USD`).                 |

#### PHP cURL Example

```php
<?php
$curl = curl_init();

$data = [
    "token" => "<TOKEN>",
    "casino" => "<CASINO>",
    "remoteId" => "<REMOTE_ID>",
    "currency" => "USD"
];

curl_setopt_array($curl, [
    CURLOPT_URL => "https://staging.agere.games/api/players/register",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => json_encode($data),
    CURLOPT_HTTPHEADER => ['Content-Type: application/json']
]);

$response = curl_exec($curl);

if (curl_errno($curl)) {
    echo "cURL Error: " . curl_error($curl);
} else {
    echo $response;
}

curl_close($curl);
```

---

### Credit or Debit User Balance API

#### API Endpoint

**URL**:
`https://staging.agere.games/api/casinos-admin/api/casino/adminBalanceDebitCredit`

**Method**: `POST`

**Description**: This API credits or debits a user's balance.

#### Input Parameters

| Parameter   | Type     | Required | Description                     |
| ----------- | -------- | -------- | ------------------------------- |
| `action`    | `string` | Yes      | Use `debit` or `credit`.        |
| `remote_id` | `string` | Yes      | The remote user identifier.     |
| `token`     | `string` | Yes      | Authentication token.           |
| `currency`  | `string` | Yes      | Currency code (e.g., `USD`).    |
| `casino`    | `string` | Yes      | Unique casino identifier.       |
| `authKey`   | `string` | Yes      | A SHA1 hash for authentication. |

#### PHP cURL Example

```php
<?php
$curl = curl_init();

$data = [
    "action" => "credit",
    "remote_id" => "<REMOTE_ID>",
    "token" => "<TOKEN>",
    "currency" => "USD",
    "casino" => "<CASINO>",
    "authKey" => sha1("<SALT_KEY> . action=credit&remote_id=<REMOTE_ID>&token=<TOKEN>&currency=USD&casino=<CASINO>")
];

curl_setopt_array($curl, [
    CURLOPT_URL => "https://staging.agere.games/api/casinos-admin/api/casino/adminBalanceDebitCredit",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => json_encode($data),
    CURLOPT_HTTPHEADER => ['Content-Type: application/json']
]);

$response = curl_exec($curl);

if (curl_errno($curl)) {
    echo "cURL Error: " . curl_error($curl);
} else {
    echo $response;
}

curl_close($curl);
```


