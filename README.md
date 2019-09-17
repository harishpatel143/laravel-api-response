# laravel-api-response

Laravel API response structure class for json response.
In this package, there are many build-in methods for different status code wise response for an API request.


### How to use

For use this package, You just need to create an object of the **ApiResponse** class

Step -1: In your Controller  
```php

    public $apiResponse = '';

    /**
     * Create a new controller instance.
     *
     * @param ApiResponse $apiResponseClass
     */
    public function __construct(ApiResponse $apiResponseClass)
    {
        $this->apiResponse = $apiResponseClass;
    }

```

Step-2: Use the **$apiResponse** object for response in your methods.

```php
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = Post::get();

        return $this->apiResponse->respondWithMessageAndPayload($posts, 'Posts has been retrieved successfully.');
    }

```

You will receive API response like below

```json

{
    "success": true,
    "message": "Posts has been retrieved successfully.",
    "payload": [
        {
            "id": 5,
            "category_id": 1,
            "user_id": 1,
            "title": "Laravel June Chapter2",
            "description": "Laravel June Chapter2",
            "updated_at": "2019-09-11 12:28:02",
        }
    ]
}

```


There are many other use full methods for API response method.

```php

return $this->apiResponse->respondWithData(array $data);
return $this->apiResponse->respondWithMessage($message = "Ok");
return $this->apiResponse->respondWithError('Posts has been retrieved successfully');
return $this->apiResponse->respondWithMessageAndPayload($payload = null, $message = "Ok");
return $this->apiResponse->respondWithError($message = "Error", $e = null, $data = null);
return $this->apiResponse->respondOk($message = "Ok");
return $this->apiResponse->respondCreated($message = "Created");
return $this->apiResponse->respondCreatedWithPayload($payload = null, $message = "Created");
return $this->apiResponse->respondUpdated($message = "Updated");
return $this->apiResponse->respondUpdatedWithPayload($payload = null, $message = "Updated");
return $this->apiResponse->respondDeleted($message = "Deleted");
return $this->apiResponse->respondDeletedWithPayload($payload = null, $message = "Deleted");
return $this->apiResponse->respondUnauthorized($message = "Unauthorized");
return $this->apiResponse->respondForbidden($message = "Forbidden");
return $this->apiResponse->respondNotFound($message = "Not Found");
return $this->apiResponse->respondValidationError($message = "Validation Error", $data = null);
return $this->apiResponse->respondInternalError($message, $e);
return $this->apiResponse->respondServiceUnavailable($message, $e);
return $this->apiResponse->respondCustomError($message, $status_code, $e);
return $this->apiResponse->respondNotImplemented($message = "Internal Error");
return $this->apiResponse->respondResourceConflict($message = "Resource Already Exists");
return $this->apiResponse->respondResourceConflictWithData($payload = null, $message = "Resource Already Exists", $responseCode = ResponseHTTP::HTTP_CONFLICT);
return $this->apiResponse->respondWithFile($file, $mime);
return $this->apiResponse->respondNoContent($message);
return $this->apiResponse->respondBadRequest($message = "Bad Request");
return $this->apiResponse->respondHTTPNotAcceptable($message = "HTTP Not Acceptable");
return $this->apiResponse->respondExceptionError($status, $message, $status_code, $payload);

```


**The package has a bellow response structure from all the method**

```

{
    "success": true,
    "message": "",
    "payload": []
}

In Debug mode

{
    "success": false,
    "message": '',
    "payload": '',
    "debug": ''
}

```

**However, if you want to change the response structure or add any new methods in for that does not exist in our package, You just need to create a custom response class and extend **ApiResponse** class. Override the **getResponseStructure** in a Custom response class and use that class to the application.**
##### e.g.

```php
namespace App\Http\Response;


use HarishPatel\ApiResponse\ApiResponse;
use Symfony\Component\HttpFoundation\Response;

class CustomApiResponse extends ApiResponse
{


    public function getResponseStructure($success = false, $payload = null, $message = '', $debug = null)
    {
        if ($success) {
            $data = [
                'message' => $message,
                'data' => $payload
            ];
        } else {
            $data = [
                'error' => [
                    'code' => Response::$statusTexts[$this->getStatusCode()],
                    'http_code' => $this->getStatusCode(),
                    'message' => $message,
                ]
            ];
        }

        return $data;
    }
}
```


## License

laravel-api-response is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).