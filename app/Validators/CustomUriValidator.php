<?php

namespace App\Validators;

use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Routing\Matching\UriValidator as LaravelUriValidator;

/**
 * Class CustomUriValidator
 * @package App\Validators
 */
class CustomUriValidator extends LaravelUriValidator
{
    /**
     * @var string
     */
    private string $apiDefaultVersion;

    /**
     * @var array
     */
    private array $apiVersions;

    /**
     * @var string
     */
    private string $apiPrefix;

    /**
     * CustomUriValidator constructor.
     */
    public function __construct()
    {
        $this->apiDefaultVersion = config('api.default_version');
        $this->apiVersions = config('api.versions');
        $this->apiPrefix = config('api.prefix');
    }

    /**
     * @param Route $route
     * @param Request $request
     * @return bool|int|null
     */
    public function matches(Route $route, Request $request)
    {
        $result = false;
        $path = rtrim($request->getPathInfo(), '/') ?: '/';
        /*
         * TODO talk: Manipulate with default version
        if (!$this->hasApiVersionInRoute($request->getUri())) {
            $path = $this->manipulatePathWithDefaultApiVersion($path);
        }
        */

        if (!$this->hasMultipleApiVersions() || $this->isApiPrefixed($path)) {
            // Default routing returned
            return preg_match($route->getCompiled()->getRegex(), rawurldecode($path));
        }

        // Loop through API versions and change the path to support API fallback to previous version
        for ($i = 0; $i < count($this->apiVersions); $i++) {
            $result = preg_match($route->getCompiled()->getRegex(), rawurldecode($path));
            if ($result) {
                // Early exit when route is found
                return $result;
            }

            if (!isset($this->apiVersions[$i + 1])) {
                continue;
            }
            $path = str_replace($this->apiVersions[$i], $this->apiVersions[$i + 1], $path);
        }

        return $result;
    }

    /**
     * @param string $path
     * @return string
     */
    private function manipulatePathWithDefaultApiVersion(string $path): string
    {
        return str_replace('api/', "api/$this->apiDefaultVersion/", $path);
    }

    /**
     * @param string $uri
     * @return bool
     */
    private function hasApiVersionInRoute(string $uri): bool
    {
        return !!preg_match('/api\/v([\d]+)/', $uri, $output_array);
    }

    /**
     * @return bool
     */
    private function hasMultipleApiVersions(): bool
    {
        return count($this->apiVersions);
    }

    /**
     * @param string $path
     * @return bool
     */
    private function isApiPrefixed(string $path): bool
    {
        return strncmp($path, $this->apiPrefix, strlen($this->apiPrefix)) !== 0;
    }
}
