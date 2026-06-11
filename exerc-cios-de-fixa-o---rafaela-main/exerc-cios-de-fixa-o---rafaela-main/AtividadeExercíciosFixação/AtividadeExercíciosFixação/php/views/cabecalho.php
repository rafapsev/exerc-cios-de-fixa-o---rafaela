<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Sistema Gerencial SGI</title>
    <style>
        :root {
            --bg-principal: #ffffff;
            --bg-navbar: #fff0f3;    
            --texto-principal: #1a1a1a;  
            --texto-secundario: #4a4a4a;
            --cor-rosa: #ff8da1;         
            --cor-rosa-hover: #ff758f;
            --borda: #f0e4e6;            
            --tabela-th: #fff5f7;
        }

        body.dark-mode {
            --bg-principal: #121214;   
            --bg-navbar: #1a1a1e;        
            --texto-principal: #ffffff;  
            --texto-secundario: #e0e0e0;
            --cor-rosa: #ff8da1;       
            --cor-rosa-hover: #ffb3c1;
            --borda: #2a2a30;
            --tabela-th: #1e1e24;
        }

        body { 
            font-family: 'Segoe UI', Arial, sans-serif; 
            margin: 25px; 
            background-color: var(--bg-principal); 
            color: var(--texto-principal); 
            transition: background 0.2s, color 0.2s; 
        }

        .navbar { 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
            padding: 15px 25px; 
            background-color: var(--bg-navbar); 
            border: 1px solid var(--borda); 
            border-radius: 8px; 
            margin-bottom: 25px; 
        }

        .navbar h2 { 
            margin: 0; 
            font-size: 1.3rem; 
            color: var(--cor-rosa); 
        }

        .nav-links { 
            display: flex; 
            gap: 18px; 
            align-items: center; 
        }

        .nav-links a { 
            text-decoration: none; 
            color: var(--texto-secundario); 
            font-weight: bold; 
            padding: 6px 12px; 
            border-radius: 4px; 
            transition: 0.2s;
        }

        .nav-links a:hover { 
            background-color: var(--bg-principal); 
            color: var(--cor-rosa); 
        }

        .btn-theme { 
            padding: 8px 16px; 
            cursor: pointer; 
            border: 1px solid var(--cor-rosa); 
            background-color: var(--cor-rosa); 
            color: #ffffff;
            border-radius: 4px; 
            font-weight: bold; 
            transition: 0.2s;
        }

        .btn-theme:hover {
            background-color: var(--cor-rosa-hover);
            border-color: var(--cor-rosa-hover);
        }

        .btn-link {
            display: inline-block;
            padding: 10px 15px;
            background-color: var(--cor-rosa);
            color: #ffffff;
            text-decoration: none;
            border-radius: 4px;
            font-weight: bold;
            transition: 0.2s;
        }
        .btn-link:hover {
            background-color: var(--cor-rosa-hover);
        }

        table { 
            border-collapse: collapse; 
            width: 100%; 
            margin: 20px 0; 
        }

        th, td { 
            border: 1px solid var(--borda); 
            padding: 12px; 
            text-align: left; 
            color: var(--texto-principal);
        }

        th { 
            background-color: var(--tabela-th); 
            color: var(--cor-rosa); 
            font-weight: bold;
        }

        input, textarea {
            width: 100%; 
            padding: 8px; 
            border: 1px solid var(--borda); 
            border-radius: 4px;
            background-color: var(--bg-principal);
            color: var(--texto-principal);
            box-sizing: border-box;
        }
        
        input:focus, textarea:focus {
            outline: none;
            border-color: var(--cor-rosa);
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <h2>Projeto - Rafaela</h2>
        <div class="nav-links">
            <a href="index.php?classe=contatos">Contatos</a>
            <a href="index.php?classe=clientes">Clientes</a>
            <a href="index.php?classe=produtos">Produtos</a>
            <button class="btn-theme" onclick="alternarTema()">Alternar Tema</button>
        </div>
    </nav>
    <script>
        if (localStorage.getItem('tema-escuro') === 'ativado') {
            document.body.classList.add('dark-mode');
        }

        function alternarTema() {
            document.body.classList.toggle('dark-mode');
            if(document.body.classList.contains('dark-mode')) {
                localStorage.setItem('tema-escuro', 'ativado');
            } else {
                localStorage.setItem('tema-escuro', 'desativado');
            }
        }
    </script>