> This is a pre request processing package of laravel

# What is my thinking?

In the daily developing , you may use the MVC pattern,  
but as the project gets bigger and bigger,  
you will find the controllers were become too fatter to maintain.  

# What should we do?

use the Ablegang/laravel-pre-request.

you may get it by :

```
composer required Ablegang/laravel-pre-request
```

or :
```
composer required chinaobject/laravel-pre-request
```

# What can the laravel-pre-request do?

- reducing the controller's complexity
- check the route parameters
- parameters assembling

Use this package , you will split the code about check from the controller.  
For example:
```
// before use this package,you may write the controller in this way

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;

class Login extends Controller
{
    public function __invoke(Request $request)
    {
        $this->validate($request,[
            'username' => 'required|email|exists:users,email'
        ],[
            'username.required' => 'username is required' ,
            'username.email' => 'username is an email' , 
            'username.exists' => 'username not found'
        ]);
    }
}
```

Ok,in this way,if the login logic is very complex,you can imagine how big the controller was.  
So,the laravel framework provides the FormRequest to solve this problem.  
But,you know,the FormRequest can only check the Request's params,it can't check the router's params.  
If you want to use the restful at your api,you may only use the "route pattern" for check params.  
As you knows,the "route pattern" can only provide simple checking,such as "required","format"...  

Use laravel-pre-request package:
```
namespace App\Http\FormRequest;

use Chinaobject\PreRequest\PreRequest;

class LoginRequest extends PreRequest
{
    public function rules()
    {
        // the check rules , you can also check the route parameters in this function
        return [
            'username' => 'required',
            'client_ids' => 'array'
        ];
    }
    
    public function messages()
    {
        // the invaild messages
        return [
            'username.*' => 'username must be required',
            'client.*' => 'client must be array'
        ];
    }
    
    public function authorize()
    {
        // the authorize check , if you want to check the authorize , you may wirte the logic for youself.
        return true;
    }
    
    public function assembling()
    {
        // the parameters assembling ,
        // before they were injected to controller,you may wang to assemble the parameters 
        
        // if the request parameters is an array[1,2,3];
        
        $client = ['web','ios','android'];
        
        $data = [];
        foreach($this->data['client'] as $v) {
            $data[] = $client[$v];
        }
        $this->data['client'] = $data;
        
        return $this->data; 
        
        // Ok,you can get the assembled data by $request->fullData() in controller.
        // Of cause , you must inject this FormRequest into your controller.
    }
}
```

That's all.Thanks for your reading.

If you have any problem , you can get some help by email <2252390865@qq.com>
