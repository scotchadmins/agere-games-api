<?php
class AgereGamingApi
{
    protected $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public function getProviders()
    {
        $url = $this->config['base_url'] . '/getAllCombineAPI?action=get_providers';
        return $this->makeRequest($url);
    }

    public function getAvailableGames($providerId, $page = 1, $gameType = 'LiveGames')
    {
        $url = $this->config['base_url'] . "/getAllCombineAPI?action=available_games&provider=$providerId&page=$page&gameType=$gameType";
        return $this->makeRequest($url);
    }

    public function getGameUrl($gameId, $params = [])
    {
        $query = http_build_query($params);
        $url = $this->config['base_url'] . "/?action=gameLoad&game_id=$gameId&$query";
        return $this->makeRequest($url);
    }

    private function makeRequest($url)
    {
        // Perform the HTTP request using Guzzle or any other HTTP client
        $response = file_get_contents($url); // Example for simplicity
        return json_decode($response, true);
    }
}
?>
