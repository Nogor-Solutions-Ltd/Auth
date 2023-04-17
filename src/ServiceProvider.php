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
        $append = function () {
            $routes = [
                "// Forget Password Route...",
                "\nRoute::get('app/password-reset', function () {
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
        };

        if ($this->app->runningInConsole()) {
            $file_path = base_path('routes/web.php');
            $search_text = "Forget Password Route...";

            if (strpos(file_get_contents($file_path), $search_text) == false) {
                $append();
            }
        }

        $this->publishes([
            __DIR__.'/publish/components' => resource_path('views/components'),
            __DIR__.'/publish/controller' => app_path('Http/Controllers'),
            __DIR__.'/publish/mail' => app_path('Mail'),
        ], 'nogor-solutions-ltd-auth');
    }
}
