<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokémon Cards</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 40px 20px;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
        }

        h1 {
            text-align: center;
            color: white;
            margin-bottom: 40px;
            font-size: 3em;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }

        .cards-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 30px;
            justify-items: center;
        }

        .card {
            background: white;
            border-radius: 20px;
            padding: 25px;
            width: 100%;
            max-width: 320px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.4);
        }

        .card-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .pokemon-name {
            font-size: 1.8em;
            font-weight: bold;
            text-transform: capitalize;
            color: #333;
            margin-bottom: 10px;
        }

        .pokemon-image {
            width: 180px;
            height: 180px;
            margin: 0 auto;
            display: block;
        }

        .pokemon-types {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin: 15px 0;
        }

        .type-badge {
            padding: 5px 15px;
            border-radius: 15px;
            font-size: 0.85em;
            font-weight: bold;
            text-transform: uppercase;
            color: white;
        }

        .stats {
            margin: 20px 0;
        }

        .stat-row {
            display: flex;
            justify-content: space-between;
            padding: 10px;
            margin: 8px 0;
            background: #f5f5f5;
            border-radius: 8px;
        }

        .stat-label {
            font-weight: bold;
            color: #555;
        }

        .stat-value {
            color: #667eea;
            font-weight: bold;
        }

        .moves {
            margin-top: 20px;
        }

        .moves-title {
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
            font-size: 1.1em;
        }

        .move-item {
            background: #667eea;
            color: white;
            padding: 8px 12px;
            margin: 6px 0;
            border-radius: 8px;
            text-transform: capitalize;
            font-size: 0.9em;
        }

        /* Colores para tipos de pokémon */
        .type-fire { background: #F08030; }
        .type-water { background: #6890F0; }
        .type-grass { background: #78C850; }
        .type-electric { background: #F8D030; }
        .type-psychic { background: #F85888; }
        .type-ice { background: #98D8D8; }
        .type-dragon { background: #7038F8; }
        .type-dark { background: #705848; }
        .type-fairy { background: #EE99AC; }
        .type-normal { background: #A8A878; }
        .type-fighting { background: #C03028; }
        .type-flying { background: #A890F0; }
        .type-poison { background: #A040A0; }
        .type-ground { background: #E0C068; }
        .type-rock { background: #B8A038; }
        .type-bug { background: #A8B820; }
        .type-ghost { background: #705898; }
        .type-steel { background: #B8B8D0; }
    </style>
</head>
<body>
<div class="container">
    <h1>🎴 Pokémon Cards 🎴</h1>
    <div class="cards-container">

        <?php
        // Lista de 5 pokémons seleccionados
        $pokemons = ['pikachu', 'charizard', 'blastoise', 'venusaur', 'mewtwo'];

        foreach ($pokemons as $pokemonName) {
            // Inicializar cURL
            $ch = curl_init();
            $url = "https://pokeapi.co/api/v2/pokemon/" . $pokemonName;

            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

            $response = curl_exec($ch);
            curl_close($ch);

            if ($response) {
                $pokemon = json_decode($response, true);

                // Extraer datos
                $name = $pokemon['name'];
                $image = $pokemon['sprites']['other']['official-artwork']['front_default'];
                $types = $pokemon['types'];

                // Buscar HP (vida)
                $hp = 0;
                foreach ($pokemon['stats'] as $stat) {
                    if ($stat['stat']['name'] == 'hp') {
                        $hp = $stat['base_stat'];
                        break;
                    }
                }

                // Buscar ataque base
                $attack = 0;
                foreach ($pokemon['stats'] as $stat) {
                    if ($stat['stat']['name'] == 'attack') {
                        $attack = $stat['base_stat'];
                        break;
                    }
                }

                // Obtener 2 movimientos
                $moves = array_slice($pokemon['moves'], 0, 2);

                // Mostrar carta
                echo '<div class="card">';
                echo '<div class="card-header">';
                echo '<h2 class="pokemon-name">' . htmlspecialchars($name) . '</h2>';
                echo '<img src="' . htmlspecialchars($image) . '" alt="' . htmlspecialchars($name) . '" class="pokemon-image">';
                echo '<div class="pokemon-types">';
                foreach ($types as $type) {
                    $typeName = $type['type']['name'];
                    echo '<span class="type-badge type-' . $typeName . '">' . $typeName . '</span>';
                }
                echo '</div>';
                echo '</div>';

                echo '<div class="stats">';
                echo '<div class="stat-row">';
                echo '<span class="stat-label">💚 Vida (HP)</span>';
                echo '<span class="stat-value">' . $hp . '</span>';
                echo '</div>';
                echo '<div class="stat-row">';
                echo '<span class="stat-label">⚔️ Ataque Base</span>';
                echo '<span class="stat-value">' . $attack . '</span>';
                echo '</div>';
                echo '</div>';

                echo '<div class="moves">';
                echo '<div class="moves-title">🎯 Movimientos:</div>';
                foreach ($moves as $move) {
                    echo '<div class="move-item">' . htmlspecialchars(str_replace('-', ' ', $move['move']['name'])) . '</div>';
                }
                echo '</div>';

                echo '</div>';
            }
        }
        ?>
    </div>
</div>
</body>
</html>