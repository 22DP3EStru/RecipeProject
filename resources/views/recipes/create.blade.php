<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Recipe - Recipe App</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 20px; background: #f5f5f5; }
        .container { max-width: 800px; margin: 0 auto; background: white; padding: 30px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .header { border-bottom: 2px solid #28a745; padding-bottom: 10px; margin-bottom: 20px; }
        .form-group { margin-bottom: 20px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; color: #333; }
        input, textarea, select { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; font-size: 14px; }
        textarea { resize: vertical; }
        .btn { background: #28a745; color: white; padding: 12px 24px; border: none; border-radius: 5px; cursor: pointer; text-decoration: none; display: inline-block; }
        .btn:hover { background: #218838; }
        .btn-secondary { background: #6c757d; }
        .btn-secondary:hover { background: #545b62; }
        .grid { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 15px; }
        .error { color: red; font-size: 12px; margin-top: 5px; }
        .section { background: #f8f9fa; padding: 20px; border-radius: 8px; margin: 20px 0; }
        .navigation { background: #333; color: white; padding: 15px; margin: -30px -30px 20px -30px; border-radius: 10px 10px 0 0; }
        .navigation a { color: white; text-decoration: none; margin-right: 15px; }
    </style>
</head>
<body>
    <div class="container">
        <!-- Navigation -->
        <div class="navigation">
            <a href="/dashboard">← Back to Dashboard</a>
            <a href="/recipes">All Recipes</a>
            <a href="/categories">Categories</a>
        </div>

        <!-- Header -->
        <div class="header">
            <h1>🍽️ Create New Recipe</h1>
            <p>Share your culinary creation with the community!</p>
        </div>

        <!-- Error Messages -->
        @if($errors->any())
            <div style="background: #f8d7da; color: #721c24; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
                <strong>Please fix the following errors:</strong>
                <ul style="margin: 10px 0 0 20px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Recipe Form -->
        <form method="POST" action="{{ route('recipes.store') }}">
            @csrf

            <!-- Basic Information -->
            <div class="section">
                <h3 style="margin-top: 0; color: #28a745;">📝 Basic Information</h3>
                
                <div class="form-group">
                    <label for="title">Recipe Title *</label>
                    <input type="text" id="title" name="title" value="{{ old('title') }}" placeholder="e.g., Grandma's Chocolate Chip Cookies" required>
                </div>

                <div class="form-group">
                    <label for="description">Description *</label>
                    <textarea id="description" name="description" rows="3" placeholder="Tell us what makes this recipe special..." required>{{ old('description') }}</textarea>
                </div>

                <div class="grid">
                    <div class="form-group">
                        <label for="category">Category *</label>
                        <select id="category" name="category" required>
                            <option value="">Select Category</option>
                            <option value="Breakfast" {{ old('category') == 'Breakfast' ? 'selected' : '' }}>🥞 Breakfast</option>
                            <option value="Lunch" {{ old('category') == 'Lunch' ? 'selected' : '' }}>🥗 Lunch</option>
                            <option value="Dinner" {{ old('category') == 'Dinner' ? 'selected' : '' }}>🍽️ Dinner</option>
                            <option value="Desserts" {{ old('category') == 'Desserts' ? 'selected' : '' }}>🍰 Desserts</option>
                            <option value="Appetizers" {{ old('category') == 'Appetizers' ? 'selected' : '' }}>🥨 Appetizers</option>
                            <option value="Main Dishes" {{ old('category') == 'Main Dishes' ? 'selected' : '' }}>🍖 Main Dishes</option>
                            <option value="Side Dishes" {{ old('category') == 'Side Dishes' ? 'selected' : '' }}>🥔 Side Dishes</option>
                            <option value="Beverages" {{ old('category') == 'Beverages' ? 'selected' : '' }}>🥤 Beverages</option>
                            <option value="Snacks" {{ old('category') == 'Snacks' ? 'selected' : '' }}>🍿 Snacks</option>
                            <option value="Vegetarian" {{ old('category') == 'Vegetarian' ? 'selected' : '' }}>🥬 Vegetarian</option>
                            <option value="Vegan" {{ old('category') == 'Vegan' ? 'selected' : '' }}>🌱 Vegan</option>
                            <option value="Gluten-Free" {{ old('category') == 'Gluten-Free' ? 'selected' : '' }}>🌾 Gluten-Free</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="difficulty">Difficulty *</label>
                        <select id="difficulty" name="difficulty" required>
                            <option value="">Select Difficulty</option>
                            <option value="Easy" {{ old('difficulty') == 'Easy' ? 'selected' : '' }}>🟢 Easy</option>
                            <option value="Medium" {{ old('difficulty') == 'Medium' ? 'selected' : '' }}>🟡 Medium</option>
                            <option value="Hard" {{ old('difficulty') == 'Hard' ? 'selected' : '' }}>🔴 Hard</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="servings">Servings</label>
                        <input type="number" id="servings" name="servings" value="{{ old('servings') }}" min="1" placeholder="4">
                    </div>
                </div>
            </div>

            <!-- Time Information -->
            <div class="section">
                <h3 style="margin-top: 0; color: #28a745;">⏱️ Time & Preparation</h3>
                
                <div class="grid">
                    <div class="form-group">
                        <label for="prep_time">Prep Time (minutes)</label>
                        <input type="number" id="prep_time" name="prep_time" value="{{ old('prep_time') }}" min="1" placeholder="15">
                    </div>

                    <div class="form-group">
                        <label for="cook_time">Cook Time (minutes)</label>
                        <input type="number" id="cook_time" name="cook_time" value="{{ old('cook_time') }}" min="1" placeholder="30">
                    </div>

                    <div class="form-group">
                        <label>Total Time</label>
                        <input type="text" readonly placeholder="Will calculate automatically" style="background: #f8f9fa;">
                    </div>
                </div>
            </div>

            <!-- Ingredients -->
            <div class="section">
                <h3 style="margin-top: 0; color: #28a745;">🧄 Ingredients *</h3>
                
                <div class="form-group">
                    <label for="ingredients">List all ingredients (one per line)</label>
                    <textarea id="ingredients" name="ingredients" rows="8" placeholder="Example:&#10;2 cups all-purpose flour&#10;1 cup granulated sugar&#10;1/2 cup butter, softened&#10;2 large eggs&#10;1 teaspoon vanilla extract&#10;1/2 teaspoon salt" required>{{ old('ingredients') }}</textarea>
                    <small style="color: #666;">💡 Tip: Include measurements and be specific (e.g., "1 cup diced onions" instead of just "onions")</small>
                </div>
            </div>

            <!-- Instructions -->
            <div class="section">
                <h3 style="margin-top: 0; color: #28a745;">📋 Instructions *</h3>
                
                <div class="form-group">
                    <label for="instructions">Step-by-step cooking instructions</label>
                    <textarea id="instructions" name="instructions" rows="10" placeholder="Example:&#10;1. Preheat your oven to 350°F (175°C)&#10;2. In a large bowl, cream together butter and sugar until light and fluffy&#10;3. Beat in eggs one at a time, then add vanilla&#10;4. Gradually mix in flour and salt until just combined&#10;5. Drop spoonfuls of dough onto baking sheet&#10;6. Bake for 10-12 minutes until edges are golden brown" required>{{ old('instructions') }}</textarea>
                    <small style="color: #666;">💡 Tip: Number your steps and be clear about temperatures, times, and techniques</small>
                </div>
            </div>

            <!-- Submit Buttons -->
            <div style="text-align: center; margin-top: 30px; padding-top: 20px; border-top: 1px solid #eee;">
                <a href="/dashboard" class="btn btn-secondary" style="margin-right: 10px;">Cancel</a>
                <button type="submit" class="btn">🍽️ Create Recipe</button>
            </div>
        </form>
    </div>

    <script>
        // Auto-calculate total time
        function updateTotalTime() {
            const prep = parseInt(document.getElementById('prep_time').value) || 0;
            const cook = parseInt(document.getElementById('cook_time').value) || 0;
            const total = prep + cook;
            const totalField = document.querySelector('input[readonly]');
            if (total > 0) {
                totalField.value = total + ' minutes';
            } else {
                totalField.value = '';
            }
        }

        document.getElementById('prep_time').addEventListener('input', updateTotalTime);
        document.getElementById('cook_time').addEventListener('input', updateTotalTime);
    </script>
</body>
</html>