<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Solicitação de Serviço</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #e6f0ff;
        }

        header {
            background-color: #7dc5f8;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
        }

        .logo {
            font-weight: bold;
            font-size: 20px;
            color: #005a9c;
        }

        .profile-img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }

        .container {
            max-width: 600px;
            margin: 40px auto;
            background-color: #f0f6ff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px #ccc;
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
        }

        label {
            display: block;
            margin: 15px 0 5px;
            font-weight: bold;
        }

        input[type="text"], textarea, select, input[type="date"] {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-bottom: 15px;
        }

        .row {
            display: flex;
            gap: 20px;
        }

        .row > div {
            flex: 1;
        }

        .buttons {
            text-align: center;
            margin-top: 20px;
        }

        .btn {
            padding: 10px 20px;
            border-radius: 5px;
            border: none;
            font-weight: bold;
            cursor: pointer;
        }

        .btn-cancel {
            background-color: white;
            border: 1px solid red;
            color: red;
            margin-right: 10px;
        }

        .btn-save {
            background-color: #007bff;
            color: white;
        }

        footer {
            background-color: #7dc5f8;
            padding: 30px 50px;
            display: flex;
            justify-content: space-between;
            font-size: 12px;
            margin-top: 50px;
        }

        footer div {
            flex: 1;
        }

        footer h4 {
            margin-bottom: 10px;
        }

        footer ul {
            list-style: none;
            padding: 0;
        }

        footer li {
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">Demanda+</div>
        <img src="https://via.placeholder.com/40" alt="Perfil" class="profile-img">
    </header>

    <div class="container">
        <h2>Solicitação de Serviço</h2>
        <form>
            <label for="titulo">Título</label>
            <input type="text" id="titulo" placeholder="Título...">

            <label for="descricao">Descrição</label>
            <textarea id="descricao" rows="5" placeholder="Descreva o serviço desejado"></textarea>

            <div class="row">
                <div>
                    <label for="categoria">Categoria</label>
                    <select id="categoria">
                        <option value="">Selecione...</option>
                    </select>
                </div>
                <div>
                    <label for="data">Data</label>
                    <input type="date" id="data">
                </div>
            </div>

            <div class="buttons">
                <button type="reset" class="btn btn-cancel">Cancelar</button>
                <button type="submit" class="btn btn-save">Salvar</button>
            </div>
        </form>
    </div>

    <footer>
        <div>
            <h4>Use cases</h4>
            <ul>
                <li>UI design</li>
                <li>UX design</li>
                <li>Wireframing</li>
                <li>Diagramming</li>
                <li>Brainstorming</li>
                <li>Online whiteboard</li>
                <li>Team collaboration</li>
            </ul>
        </div>
        <div>
            <h4>Explore</h4>
            <ul>
                <li>Design</li>
                <li>Prototyping</li>
                <li>Development features</li>
                <li>Design systems</li>
                <li>Collaboration features</li>
                <li>Design process</li>
                <li>Figma</li>
            </ul>
        </div>
        <div>
            <h4>Resources</h4>
            <ul>
                <li>Blog</li>
                <li>Best practices</li>
                <li>Cases</li>
                <li>Color wheel</li>
                <li>Support</li>
                <li>Developers</li>
                <li>Resource library</li>
            </ul>
        </div>
    </footer>
</body>
</html>
