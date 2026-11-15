<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pokédex CBA</title>
  <style>
    /* Mejora visual y diseño responsive */
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
      max-width: 380px;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      padding: 24px;
      text-align: center;
    }

    h1 {
      color: #e3350d;
      margin-top: 0;
    }

    input[type="text"] {
      width: 100%;
      padding: 10px;
      margin: 12px 0;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 16px;
    }

    button {
      width: 100%;
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
      <form action="pokemon.php" method="GET">
        <label for="pokemon">Nombre o ID del Pokémon:</label>
        <input
          type="text"
          id="pokemon"
          name="pokemon"
          placeholder="Ej: pikachu o 25"
          required
        >
        <button type="submit">Buscar</button>
      </form>
      <a class="enlace-equipo" href="equipo.php">Ver mi equipo</a>
    </div>
  </div>
</body>
</html>
