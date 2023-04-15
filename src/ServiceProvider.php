<?php

namespace NogorSolutionsLTD\Auth;

use Illuminate\Support\Facades\File;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/publish/components' => function () {
                $routes = [
                    "\n// Forget Password Route...
                    Route::get('app/password-reset', function () {
                        return view('reset'); # define your reset page views...
                    });\n",
                    "Route::post('app/forget', [ForgetPasswordController::class, 'store'])->name('app.forget.store');\n",
                    "Route::post('app/password-reset', [ResetPasswordController::class, 'store'])->name('app.password.store');\n"];

                foreach ($routes as $route) {
                    file_put_contents(
                        base_path('routes/web.php'),
                        "$route",
                        FILE_APPEND
                    );
                }

                return resource_path('views/components');
            },
            __DIR__.'/publish/controller' => app_path('Http/Controllers'),
            __DIR__.'/publish/mail' => app_path('Http/Controllers'),
        ], 'nogor-solutions-ltd-auth');
    }
}
