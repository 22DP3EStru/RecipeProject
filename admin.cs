using Microsoft.AspNetCore.Builder;
using Microsoft.AspNetCore.Hosting;
using Microsoft.AspNetCore.Http;
using Microsoft.Extensions.DependencyInjection;
using Microsoft.Extensions.Hosting;
using System.Collections.Generic;

namespace RecipeApi
{
    public class Startup
    {
        public void ConfigureServices(IServiceCollection services)
        {
            services.AddControllers();
        }

        public void Configure(IApplicationBuilder app, IWebHostEnvironment env)
        {
            if (env.IsDevelopment())
            {
                app.UseDeveloperExceptionPage();
            }

            app.UseRouting();

            app.UseEndpoints(endpoints =>
            {
                endpoints.MapGet("/recipes", async context =>
                {
                    var recipes = new List<object>
                    {
                        new { Id = 1, Name = "Pasta Carbonara", Ingredients = "Pasta, Eggs, Bacon, Parmesan" },
                        new { Id = 2, Name = "Tomato Soup", Ingredients = "Tomatoes, Onion, Garlic, Basil" }
                    };
                    await context.Response.WriteAsJsonAsync(recipes);
                });

                endpoints.MapGet("/admin", async context =>
                {
                    var adminFunctions = new List<string>
                    {
                        "Add Recipe",
                        "Edit Recipe",
                        "Delete Recipe",
                        "Manage Users"
                    };
                    await context.Response.WriteAsJsonAsync(new { Role = "Administrator", Functions = adminFunctions });
                });
            });
        }
    }
}
