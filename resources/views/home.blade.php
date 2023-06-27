<!DOCTYPE html>
@extends('headers.sidebar')

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <title>StockControl</title>
  <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<html>
  <script src="https://d3js.org/d3.v4.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/billboard.js/dist/billboard.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/billboard.js/dist/billboard.min.css"/>
  <link rel="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" type="text/css"/>
  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.1/Chart.min.js"></script>
  
  <style>
    body {
        margin-top: 150px;
        margin-left: 480px;
    }
    h2 {
        text-align: left;
        font-family: "Verdana", sans-serif;
        font-size: 40px;
        margin-left: 340px;
        font-weight: 300;
    }

    .form-group {
        width: 300dp;
        margin-top: 30px;
        margin-bottom: 40px;
        margin-left: 350px;
    }
    
    option {
        text-align: center;
    }

    .col-12 {
        display:flex;
        margin-top: 0px;
    }

    .card {
        /* margin-top: 0px; */
        /* display:list-item; */
        /* float: right; */
        margin-left: 900px;
        /* position: fixed; */
        display: block;
        width: 300px;
        border: 1px solid black;
        border-radius: 5px;
        padding: 20px;
        background-color: #f8f9fa;
        margin-bottom: 20px;
    }

    .card-title {
        font-size: 18px;
        font-weight: bold;
    }
    .card-text {
        font-size: 14px;
        margin-bottom: 10px;
    }
    .card-price {
        font-size: 16px;
        font-weight: bold;
    }
    .text-right {
        margin-top: -500px;
    }
    
    .bb-chart-arc-Alert {
        fill: green; /* Altere para a cor verde desejada */
    }
    .bb-chart-arc-Crítico {
        fill: red; /* Altere para a cor vermelha desejada */
    }
    .bb-chart-arc-Satisfatório {
        fill: yellow; /* Altere para a cor amarela desejada */
    }
  </style>
  <body>
    <div class="container">
        <div class="container-fluid">
        <div class="row">
        <div class="col-md-9">
            <div class="row justify-content-start">
                <div class="col-12 text-center">
                    <h2>Stock Control</h2>
                </div>
                <br>
                <div class="form-group">
                    <label for="color-select">Selecione o Produto:</label>
                    <select class="form-control" id="color-select">
                    <option value="green">Bebidas</option>
                    <option value="red">Produtos da Cozinha</option>
                    <option value="yellow">Produtos Sushi</option>
                    </select>
                </div>
                <br>
                <div class="col-12 col-md-4">
                    <div id="donut-chart"></div>
                </div>
                <div class="text-right" id="card-container">
                    <!-- Os cards serão adicionados aqui -->
                </div>
            </div>
            </div>
        </div>
    </div>
    <script>
      var chart = bb.generate({
        data: {
          columns: [
            ["Alert", 2],
            ["Crítico", 4],
            ["Satisfatório", 3],
          ],
          type: "donut",
          onclick: function (d, i) {
            console.log("onclick", d, i);
          },
          onover: function (d, i) {
            console.log("onover", d, i);
          },
          onout: function (d, i) {
            console.log("onout", d, i);
          },
        },
        donut: {
          title: "70",
        },
        bindto: "#donut-chart",
      });
      
        document.addEventListener("DOMContentLoaded", function() {
            var cardContainer = document.getElementById("card-container");

            for (var i = 1; i <= 4; i++) {
            var card = document.createElement("div");
            card.className = "card bg-primary text-white";

            var cardBody = document.createElement("div");
            cardBody.className = "card-body";

            var cardTitle = document.createElement("h5");
            cardTitle.className = "card-title";
            cardTitle.textContent = "Nome do Produto " + i;

            var cardDescription = document.createElement("p");
            cardDescription.className = "card-text";
            cardDescription.textContent = "Descrição do Produto " + i;

            var cardQuantity = document.createElement("p");
            cardQuantity.className = "card-text";
            cardQuantity.textContent = "Quantidade: XX";

            cardBody.appendChild(cardTitle);
            cardBody.appendChild(cardDescription);
            cardBody.appendChild(cardQuantity);

            card.appendChild(cardBody);

            cardContainer.appendChild(card);
            }
        });
    </script>
  </body>
</html>
