<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Productos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f9f9f9;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .categoria {
            font-size: 1.5em;
            margin-top: 20px;
            color: #444;
        }
        .producto {
            margin: 5px 0;
            display: flex;
            align-items: center;
        }
        .producto label {
            font-weight: bold;
            margin-right: 10px;
            background-color: #fffbcc;
            padding: 2px 5px;
            border-radius: 5px;
        }
        .producto input {
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .producto input.cambiado {
            background-color: #d4fcd4;
        }
        #enviar, #agregar {
            margin-top: 20px;
            display: block;
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
        }
        #enviar:hover, #agregar:hover {
            background-color: #218838;
        }
        img {
            display: block;
            margin: 0 auto;
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
    <img src="sky.jpeg" alt="Banner">
    <h1>Lista de Productos</h1>
    <div id="productos-container">
        <?php
        $productos = [
            "Verduras" => ["Papa", "Cebolla", "Zanahoria", "Zapallito", "Zucchini", "Tomate", "Tomates cherry", "Rúcula", "Lechuga Repollada", "Ajo", "Jengibre", "Pepino", "Naranja", "Pomelo Rosado", "Mandioca", "Menta"],
            "Carnes" => ["Lomo", "Bife de Chorizo", "Costilla de cerdo", "Bondiola", "Pechuga de pollo", "Nalga", "Molida Keppe Crudo"],
            "Pescados y Mariscos" => ["Surubí", "Pacú", "Salmón", "Mejillones", "Rabas", "Langostinos", "Congelados"],
            "Pastas" => ["Fetuccini", "Spaghetti", "Sorrentinos J y Q", "Ravioles de calabaza", "Ravioles de verduras", "Fideos Tallarines", "Fideo Tirabuzón"],
            "Lácteos" => ["Leche", "Crema de leche", "Queso azul", "Queso barra", "Queso cremoso", "Provoleta", "Queso sardo"],
            "Embutidos" => ["Salame", "Jamón"],
            "Panadería" => ["Pan rallado", "Pan de lomo", "Grisines", "Margaritas", "Hojaldre"],
            "Especias y Condimentos" => ["7 Especias", "Orégano", "Provenzal", "Romero", "Comino", "Curry", "Pimienta en grano", "Pimienta en polvo"],
            "Despensa" => ["Aceite de oliva", "Aceite", "Harina", "Arroz", "Azúcar", "Garbanzos", "Almendras", "Nuez", "Dulce de leche", "Miel", "Salsa de soja", "Trigo", "Vino blanco", "Vino tinto", "Ananá en lata", "Maracuyá", "Frutos Rojos"]
        ];

        foreach ($productos as $categoria => $items) {
            echo "<div class='categoria'>$categoria</div>";
            foreach ($items as $producto) {
                echo "<div class='producto'>
                        <label>$producto:</label>
                        <input type='text' placeholder='Cantidad en kg/unidad' class='cantidad'>
                      </div>";
            }
        }
        ?>
    </div>
    <button id="agregar">Agregar Producto</button>
    <button id="enviar">Enviar por WhatsApp</button>

    <script>
        // Función para asignar eventos a los inputs
        function actualizarEventosInputs() {
            const inputs = document.querySelectorAll('.cantidad');
            inputs.forEach(input => {
                input.addEventListener('input', () => {
                    input.classList.add('cambiado');
                });
            });
        }
        actualizarEventosInputs();

        // Enviar los datos por WhatsApp
        document.getElementById('enviar').addEventListener('click', () => {
            let mensaje = "Lista de productos:%0A";
            const inputs = document.querySelectorAll('.cantidad');
            inputs.forEach(input => {
                const producto = input.previousElementSibling.textContent;
                const cantidad = input.value.trim();
                if (cantidad) {
                    mensaje += `${producto} ${cantidad}%0A`;
                }
            });
            const url = `https://wa.me/?text=${mensaje}`;
            window.open(url, '_blank');
        });

        // Agregar un nuevo producto
        document.getElementById('agregar').addEventListener('click', () => {
            const categorias = Array.from(document.querySelectorAll('.categoria')).map(c => c.textContent);
            const categoriaSeleccionada = prompt("Selecciona una categoría:\n" + categorias.join("\n"));

            if (categoriaSeleccionada && categorias.includes(categoriaSeleccionada)) {
                const nuevoProducto = prompt("Escribe el nombre del nuevo producto:");
                if (nuevoProducto) {
                    const categoriaElemento = Array.from(document.querySelectorAll('.categoria')).find(el => el.textContent === categoriaSeleccionada);
                    const nuevoElemento = document.createElement('div');
                    nuevoElemento.classList.add('producto');
                    nuevoElemento.innerHTML = `
                        <label>${nuevoProducto}:</label>
                        <input type='text' placeholder='Cantidad en kg/unidad' class='cantidad'>
                    `;
                    categoriaElemento.insertAdjacentElement('afterend', nuevoElemento);

                    // Asignar eventos al nuevo input
                    actualizarEventosInputs();
                }
            } else {
                alert("Categoría no válida.");
            }
        });
    </script>
</body>
</html>
