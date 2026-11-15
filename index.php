<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pokédex CBA</title>
  <style>
    * {
      box-sizing: border-box;
      font-family: Arial, sans-serif;
    }

    body {
      background-color: #f4f6f9;
      margin: 0;
      padding: 20px;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
    }

    .contenedor {
      display: flex;
      flex-wrap: wrap;
      gap: 16px;
      justify-content: center;
      width: 100%;
    }

    .tarjeta {
      background-color: #ffffff;
      width: 100%;
      max-width: 400px;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      padding: 24px;
      text-align: center;
    }

    h1 {
      color: #e3350d;
      margin-top: 0;
    }

    label {
      display: block;
      text-align: left;
      font-weight: bold;
      margin-top: 10px;
      color: #333;
    }

    input[type="text"], select {
      width: 100%;
      padding: 10px;
      margin: 8px 0 12px 0;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 16px;
    }

    .grupo-botones {
      display: flex;
      gap: 8px;
    }

    button {
      flex: 1;
      padding: 10px;
      background-color: #e3350d;
      color: white;
      border: none;
      border-radius: 6px;
      font-size: 16px;
      cursor: pointer;
    }

    button:hover {
      background-color: #c22b09;
    }

    .btn-recargar {
      background-color: #6c757d;
    }

    .btn-recargar:hover {
      background-color: #545b62;
    }

    .enlace-equipo {
      display: inline-block;
      margin-top: 16px;
      color: #2a75bb;
      text-decoration: none;
      font-weight: bold;
    }

    @media (max-width: 600px) {
      body {
        padding: 12px;
      }
      .tarjeta {
        max-width: 100%;
        padding: 18px;
      }
    }
  </style>
</head>
<body>
  <div class="contenedor">
    <div class="tarjeta">
      <h1>Pokédex CBA</h1>
      
      <!-- Búsqueda directa por nombre o ID -->
      <form action="pokemon.php" method="GET">
        <label for="pokemon">Buscar por nombre o ID:</label>
        <input
          type="text"
          id="pokemon"
          name="pokemon"
          placeholder="Ej: pikachu o 25"
          required
        >
        <div class="grupo-botones">
          <button type="submit">Buscar</button>
          <button type="reset" class="btn-recargar">Limpiar</button>
        </div>
      </form>

      <hr style="margin: 20px 0; border: 0; border-top: 1px solid #eee;">

      <!-- Filtro rápido por selector -->
      <form action="pokemon.php" method="GET">
        <label for="filtro-rapido">Filtro rápido (Iniciales):</label>
        <select id="filtro-rapido" name="pokemon" required>
          <option value="">-- Selecciona un Pokémon --</option>
          <option value="bulbasaur">Bulbasaur (#1 - Planta)</option>
          <option value="charmander">Charmander (#4 - Fuego)</option>
          <option value="squirtle">Squirtle (#7 - Agua)</option>
          <option value="pikachu">Pikachu (#25 - Eléctrico)</option>
          <option value="eevee">Eevee (#133 - Normal)</option>
        </select>
        <button type="submit">Consultar selección</button>
      </form>

      <a class="enlace-equipo" href="equipo.php">Ver mi equipo</a>
    </div>
  </div>
</body>
</html>
