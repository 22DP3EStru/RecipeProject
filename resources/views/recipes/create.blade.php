<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Recipe - Recipe App</title>
    <link rel="stylesheet" href="/css/welcome-style.css">
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>🍽️ Create New Recipe</h1>
            <p>Share your culinary masterpiece with the world</p>
        </div>

        <!-- Navigation -->
        <nav class="nav-bar">
            <a href="/dashboard" class="nav-brand">🍽️ Recipe App</a>
            <div class="nav-links">
                <a href="/dashboard">🏠 Dashboard</a>
                <a href="/recipes">🍽️ Recipes</a>
                <a href="/categories">📂 Categories</a>
                <a href="/profile/recipes">📝 My Recipes</a>
                @if(Auth::user()->is_admin)
                    <a href="{{ route('admin.index') }}">🔧 Admin</a>
                @endif
            </div>
            <div style="display: flex; align-items: center; gap: 15px;">
                <span class="nav-user">👤 {{ Auth::user()->name }}</span>
                <a href="/dashboard" class="btn btn-logout">← Dashboard</a>
            </div>
        </nav>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Error Messages -->
            @if($errors->any())
                <div class="alert alert-error">
                    <h4 style="margin-bottom: 10px;">❌ Please fix the following errors:</h4>
                    <ul style="margin-left: 20px;">
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
                    <h3 class="section-title">📝 Basic Information</h3>
                    
                    <div class="form-group">
                        <label class="form-label" for="title">Recipe Title *</label>
                        <input type="text" id="title" name="title" value="{{ old('title') }}" 
                               class="form-input" placeholder="e.g., Grandma's Famous Chocolate Chip Cookies" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="description">Description *</label>
                        <textarea id="description" name="description" rows="3" 
                                  class="form-textarea" placeholder="Tell us what makes this recipe special..." required>{{ old('description') }}</textarea>
                    </div>

                    <div class="grid grid-3">
                        <div class="form-group">
                            <label class="form-label" for="category">Category *</label>
                            <select id="category" name="category" class="form-select" required>
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
                            <label class="form-label" for="difficulty">Difficulty *</label>
                            <select id="difficulty" name="difficulty" class="form-select" required>
                                <option value="">Select Difficulty</option>
                                <option value="Easy" {{ old('difficulty') == 'Easy' ? 'selected' : '' }}>🟢 Easy</option>
                                <option value="Medium" {{ old('difficulty') == 'Medium' ? 'selected' : '' }}>🟡 Medium</option>
                                <option value="Hard" {{ old('difficulty') == 'Hard' ? 'selected' : '' }}>🔴 Hard</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="servings">Servings</label>
                            <input type="number" id="servings" name="servings" value="{{ old('servings') }}" 
                                   min="1" class="form-input" placeholder="4">
                        </div>
                    </div>
                </div>

                <!-- Time Information -->
                <div class="section">
                    <h3 class="section-title">⏱️ Time & Preparation</h3>
                    
                    <div class="grid grid-3">
                        <div class="form-group">
                            <label class="form-label" for="prep_time">Prep Time (minutes)</label>
                            <input type="number" id="prep_time" name="prep_time" value="{{ old('prep_time') }}" 
                                   min="1" class="form-input" placeholder="15">
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="cook_time">Cook Time (minutes)</label>
                            <input type="number" id="cook_time" name="cook_time" value="{{ old('cook_time') }}" 
                                   min="1" class="form-input" placeholder="30">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Total Time</label>
                            <input type="text" id="total_time" readonly class="form-input" 
                                   placeholder="Auto calculated" style="background: rgba(240, 248, 255, 0.5);">
                        </div>
                    </div>
                </div>

                <!-- Ingredients -->
                <div class="section">
                    <h3 class="section-title">🧄 Ingredients *</h3>
                    
                    <div class="form-group">
                        <label class="form-label" for="ingredients">List all ingredients (one per line)</label>
                        <textarea id="ingredients" name="ingredients" rows="8" class="form-textarea" 
                                  placeholder="Example:&#10;2 cups all-purpose flour&#10;1 cup granulated sugar&#10;1/2 cup butter, softened&#10;2 large eggs&#10;1 teaspoon vanilla extract&#10;1/2 teaspoon salt" required>{{ old('ingredients') }}</textarea>
                        <small style="color: #666; font-style: italic;">💡 Tip: Include measurements and be specific</small>
                    </div>
                </div>

                <!-- Instructions -->
                <div class="section">
                    <h3 class="section-title">📋 Instructions *</h3>
                    
                    <div class="form-group">
                        <label class="form-label" for="instructions">Step-by-step cooking instructions</label>
                        <textarea id="instructions" name="instructions" rows="10" class="form-textarea" 
                                  placeholder="Example:&#10;1. Preheat your oven to 350°F (175°C)&#10;2. In a large bowl, cream together butter and sugar&#10;3. Beat in eggs one at a time, then add vanilla&#10;4. Gradually mix in flour and salt&#10;5. Drop spoonfuls of dough onto baking sheet&#10;6. Bake for 10-12 minutes until golden brown" required>{{ old('instructions') }}</textarea>
                        <small style="color: #666; font-style: italic;">💡 Tip: Number your steps clearly</small>
                    </div>
                </div>

                <!-- Submit Buttons -->
                <div class="text-center" style="margin-top: 30px;">
                    <a href="/dashboard" class="btn btn-danger" style="margin-right: 15px;">Cancel</a>
                    <button type="submit" class="btn btn-success">🍽️ Create Recipe</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Auto-calculate total time
        function updateTotalTime() {
            const prep = parseInt(document.getElementById('prep_time').value) || 0;
            const cook = parseInt(document.getElementById('cook_time').value) || 0;
            const total = prep + cook;
            const totalField = document.getElementById('total_time');
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