<!DOCTYPE html>
<html lang="id">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalkulator</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            text-align: center;
            background-color: #4A4A4A;
        }
        .calculator {
            width: 300px;
            margin: 50px auto;
            padding: 2%;
            background: #333;
            border-radius: 10px;
            box-shadow: 2px 4px 10px rgba(0, 0, 0, 0.5);
            text-align: center;
        }
        .screen {
            padding : 5px;
            color: #F8F9FA;
            height: 75px;
            font-size: 24px;
            text-align: right;
            border: none;
            background: #4A4A4A;
            border-radius: 5px;
            margin-bottom: 10px;
            //grid-column: span 4;
        }
        .buttons {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
        }
        button {
            width: 100%;
            height: 50px;
            font-size: 20px;
            font-weight: bold;
            background: #4A4A4A;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button.operator {
            background: #333;
        }
        button.equal {
            background: #FFC107;
        }
        button.clear {
            background: #dc3545;
            grid-column: span 3;
        }
        button.backspace {
            background: #6c757d;
        }
        button:active {
            transform: scale(0.7);
        }
        button:hover {
            opacity: 0.6;
        }
    </style>
</head>
<body>

    <div class="calculator">
        <input type="text" id="expression" class="screen" readonly>
        <div class="buttons">
            <button onclick="appendNumber('7')">7</button>
            <button onclick="appendNumber('8')">8</button>
            <button onclick="appendNumber('9')">9</button>
            <button class="backspace" onclick="backspace()">⌫</button>
            
            <button onclick="appendNumber('4')">4</button>
            <button onclick="appendNumber('5')">5</button>
            <button onclick="appendNumber('6')">6</button>
            <button class="operator" onclick="appendNumber('+')">+</button>
            
            <button onclick="appendNumber('1')">1</button>
            <button onclick="appendNumber('2')">2</button>
            <button onclick="appendNumber('3')">3</button>
            <button class="operator" onclick="appendNumber('-')">-</button>
            
            <button onclick="appendNumber('0')">0</button>
            <button onclick="appendNumber('.')">.</button>
            <button class="equal" onclick="calculate()">=</button>
            <button class="operator" onclick="appendNumber('*')">×</button>
            
            <button class="clear" onclick="clearScreen()">C</button>
            <button class="operator" onclick="appendNumber('/')">÷</button>
        </div>
    </div>

    <script>
        function appendNumber(value) {
            document.getElementById('expression').value += value;
        }

        function clearScreen() {
            document.getElementById('expression').value = '';
        }

        function backspace() {
            let expression = document.getElementById('expression').value;
            document.getElementById('expression').value = expression.slice(0, -1);
        }

        function calculate() {
            let expression = document.getElementById('expression').value;

            fetch("{{ route('calculate') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({ expression: expression })
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById('expression').value = data.result;
            })
            .catch(error => console.error("Error:", error));
        }
    </script>

</body> 
</html>