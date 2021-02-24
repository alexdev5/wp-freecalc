
<style>

	*{
      font-family: 'Open Sans', sans-serif !important;
      /*font-family: 'Panton', sans-serif;*/
      /*font-family: 'Roboto Condensed', sans-serif;*/
      /*font-family: 'Roboto Condensed', sans-serif;*/
      /*font-family: 'Oswald', sans-serif;*/
      /*font-family: 'PT Sans Caption', sans-serif;*/
      font-weight: 400;
	}
   body{
      margin-left: 0;
      margin-right: 0;
   }
   .footer,
   footer{
      margin-left: 0;
      margin-right: 0;
   }
	table{
		width: 100%;
		border-collapse: collapse;
	}
	table p{
		margin: 0;
	}
	small{
		font-size: 80%;
	}
   h2{
      font-weight: 600;
      font-size: 22px;
      margin: 0;
   }
	.ib{
		display: inline-block;
	}
	.bdb{
		border-bottom: 1px solid #393939 !important;
	}
	.mb40{
		margin-bottom: 40px;
	}
	.mb20{
		margin-bottom: 20px;
	}
	.tt-upper{
		text-transform: uppercase;
	}
	.c-green{
		color: #589F14;
	}
	.c-red{
		color: red;
	}
   .c-grey{
      color: #7A7F80;
   }
    .b-red{
        border: 1px solid red;
    }
   .to-lower{
      text-transform: lowercase;
   }
   .bd-red{
      border: 1px solid red;
   }

   .bg-stamp{
      position: absolute;
      top: 0;
      right: 0;
      width: 510px;
      height: 1250px;
      z-index: 1;

   }
   .bg-stamp img,
   .bg-stamp svg{
      max-width: 100%;
      position: absolute;
      top: 0;
   }

   .bg-stamp.bg-stamp-2{
      top: 1300px;
   }
   .bg-stamp.bg-stamp-2 img,
   .bg-stamp.bg-stamp-2 svg{
      top: 0;
   }
   /* Страница "поддоконник в ванную" */
   .body-worktop-bathroom .bg-stamp.bg-stamp-2{
      top: 1325px;
   }

   .body-windowsill-line .bg-stamp.bg-stamp-2{
      top: 1380px;
   }
	/* Шапка документа <table>*/
    a{
        text-decoration: none !important;
       color: #000 !important;
    }
   .header{
      margin: 0;
      margin-bottom: 50px;
      height: 120px;
      position: relative;
      z-index: 10;
   }
   .header .logo{
      vertical-align: middle;
   }
   .header .logo-img{
      width: 70px;
      vertical-align: middle;
   }
   .header .logo-img img{
      max-width: 100%;
   }
   .header .logo-text{
      font-size: 34px;
      min-width: 200px;
      color: #000;
      font-weight: 700;
      vertical-align: middle;
      margin-left: 10px;
   }
   .header .logo small{
      color: #163CAD;
      display: block;
      font-weight: 500;
      font-size: 12px;
      margin-top: 5px;
      margin-left: 10px;
   }
   .logo span{
      display: inline-block;
   }
   .header td{
      /*height: 60px;*/
      width: 50%;
      vertical-align: middle;
      padding: 25px 30px;
      font-size: 14px;
   }
   .header td:last-child{
      text-align: right;
   }
   .header td p{
   }
   .wrapper{
       padding-left: 10px;
       padding-right: 10px;
      position: relative;
      z-index: 10;
   }
   .header-text{
      text-align: center;
      margin-bottom: 20px;
      margin-top: 70px;
      padding: 0;
   }
   .text-after-calc{
       padding-left: 30px;
       margin-top: 30px;
   }

   /* Дополнительная информация деталицации */
   .detail-add{
      text-align: center;
      margin-top: 150px;
      margin-bottom: 150px;
   }
   .body-worktop-bathroom .detail-add,
   .body-windowsill-line .detail-add{
      margin-bottom: 170px;
   }
   .windowsill-line+.detail-add{
      margin-top: 200px;
      margin-bottom: 170px;
   }
   .detail-add td{
      text-align: center;
   }
   .detail-add > div:last-child{
       margin-right: 0;
   }
   .detail-add .detail-add__text{
       text-align: center;
      font-size: 16px;
   }
   .detail-add .detail-add__block{
      height: 220px;
      width: 220px;
      background: #fff;
      border: 1px solid red;
      position: relative;
      margin-left: auto;
      margin-right: auto;
      margin-top: 10px;
   }
   .detail-add__block img {
      display: block;
      position: absolute;
      top: -30px;
      bottom: 0;
      left: 0;
      right: 0;
      margin: auto;
      max-width: 90%;
      max-height: 60%;
   }
   .detail-add__block .add-text{
      width: 100%;
       position: absolute;
      bottom: 10px;
      font-weight: 600;
       text-align: center;
      line-height: 1.4;
   }
	/* Расчет */
    .detailing-header{
      margin-bottom: 45px;
       margin-top: 70px;
      text-align: center;
    }
	.detailing{
      margin-bottom: 0;
   }
	.detailing th{
      text-align: center;
      font-size: 16px;
      background: #FFE699;
      padding: 3px 5px;
      vertical-align: middle;
      text-transform: none;
      line-height: 1.3;
      font-weight: 500;
    }
	.detailing td{
		margin: 0;
      font-size: 15px;
      font-weight: 300;
      line-height: 1.14;
      padding: 5px 5px;
      vertical-align: middle;
	}
   .detailing td:first-child{
      text-align: center;
   }
   .detailing td:last-child{
      text-align: center;
   }
   .detailing tr:nth-child(odd) td{
      background: #FFF5D6;
   }
   .detailing tr:nth-child(even) td{
      background: #FFF;
   }

        /* Total */
   .ta-center{
      text-align: center;
   }
	.total{
      margin: 0;
   }
	.total td{
      background: #FFE699;
      vertical-align: middle;
      padding-left: 10px;
      padding-right: 10px;
      height: 50px;
   }
   .total td:first-child{
      padding-left: 20px;
   }
   .total td:last-child{
      padding-right: 20px;
   }
	.total .total-sum{
		font-size: 22px;
		font-weight: 500;
      text-align: right;
	}

   /* Текст в конце страницы */
   .text-after-calc{

   }
   .text-after-calc p+p{
      font-size: 13px !important;
      margin-left: 20px;
      margin-bottom: 8px;
   }


    /*-------------- Чеки на столешнице -------------*/
   .freecalc .worktop-comp{
      position: relative;
      cursor: default;
      margin-left: auto;
      margin-right: auto;
      height: 500px;
      margin-top: 36px;
   }
   .freecalc .worktop-comp__relative{
      width: 960px;
      position: absolute;
      margin-left: auto;
      margin-right: auto;
   }
   .freecalc .worktop-comp svg,
   .freecalc .worktop-comp img{
      display: block;
      max-width: 900px;
      max-height: 460px;
      margin-left: auto;
      margin-right: auto;
   }
   .freecalc .worktop-p svg,
   .freecalc .worktop-p img,
   .freecalc .worktop-g svg,
   .freecalc .worktop-g img{
      max-width: 937px;
      max-height: 527px;
   }

   .freecalc .worktop-comp .size{
      border: none;
      position: absolute;
   }
   .freecalc .check-mark{
      display: block;
      position: absolute;
      width: 15px;
      height: 15px;
      z-index: 10;
      border: 1px solid #E6340D;
   }
   .freecalc .check-mark.checked{
      background: red;
   }
   .freecalc .absolute{
      position: absolute;
   }

   .freecalc .size{
      width: 62px;
      height: 30px;
      display: block;
   }

   /* Прямая столешница */
   .freecalc .worktop-line .worktop-comp__relative{
      height: 190px;
      top: 25%;
   }
   .freecalc .worktop-line .check-mark-1{
      top: 67.8%;
      left: 22.2%;
   }
   .freecalc .worktop-line .check-mark-2{
      top: 0;
      left: 22.2%;
   }
   .freecalc .worktop-line .check-mark-3{
      top: 0;
      left: 77%;
   }
   .freecalc .worktop-line .check-mark-4{
      top: 68.5%;
      left: 77%;
   }
   .freecalc .worktop-line .check-panel{
      top: 33%;
      left: 27%;
   }

   /* number-width */
   .freecalc .worktop-line .w1{
      top: 34%;
      left: 87.5%;
   }
   /*  */
   .freecalc .worktop-line .l1{
      top: 84.5%;
      left: 46.9%;
   }


   /* Г - образная столешница */
   .freecalc .worktop-g .check-mark-1{
      top: 41.6%;
      left: 21.8%;
   }
   .freecalc .worktop-g .check-mark-2{
      top: 15.4%;
      left: 21.8%;
   }
   .freecalc .worktop-g .check-mark-3{
      top: 15.4%;
      left: 77.2%;
   }
   .freecalc .worktop-g .check-mark-4{
      top: 82.5%;
      left: 77.5%;
   }
   .freecalc .worktop-g .check-mark-5{
      top: 82.5%;
      left: 63.5%;
   }
   .freecalc .worktop-g .check-panel{
      top: 38%;
      left: 34%;
   }

   /* number-width */
   .freecalc .worktop-g .w1{
      top: 28.2%;
      left: 8%;
   }
   .freecalc .worktop-g .w2{
      top: 95%;
      left: 69.4%;
   }
   /*  */
   .freecalc .worktop-g .l1{
      top: 0.7%;
      left: 48%;
   }
   .freecalc .worktop-g .l2{
      top: 48.5%;
      left: 89.8%;
   }

   /* П-образная столешница */
   .freecalc .worktop-p .check-mark-1{
      top: 65.5%;
      left: 21.8%;
   }
   .freecalc .worktop-p .check-mark-2{
      top: 15.4%;
      left: 21.8%;
   }
   .freecalc .worktop-p .check-mark-3{
      top: 15.4%;
      left: 77.2%;
   }
   .freecalc .worktop-p .check-mark-4{
      top: 82.5%;
      left: 77.2%;
   }
   .freecalc .worktop-p .check-mark-5{
      top: 82.5%;
      left: 63.5%;
   }
   .freecalc .worktop-p .check-mark-6{
      top: 65.5%;
      left: 35.4%;
   }
   .freecalc .worktop-p .check-panel{
      top: 38%;
      left: 34%;
   }

   /* number-width */
   .freecalc .worktop-p .w1{
      top: 29%;
       left: 47%;
   }
   .freecalc .worktop-p .w2{
      top: 77.5%;
      left: 27.8%;
   }
   .freecalc .worktop-p .w3{
      top: 94.5%;
       left: 69.3%;
   }
   /*  */
   .freecalc .worktop-p .l1{
      top: 0.7%;
       left: 48.5%;
   }
   .freecalc .worktop-p .l2{
      top: 39.6%;
      left: 8%;
   }
   .freecalc .worktop-p .l3{
      top: 48.2%;
       left: 89.5%;
   }

   /* Столешница в ванную */
   b{
      font-weight: 600 !important;
   }
   .freecalc .worktop-bathroom .worktop-comp__relative{
      height: 197px;
      top: 25%;
      padding-left: 20px;
   }
   .freecalc .worktop-bathroom .w1{
      top: 17%;
      left: 89%;
   }
   .freecalc .worktop-bathroom .l1{
      top: 79%;
      left: 39.1%;
   }

   /* Подоконник прямой*/
   .freecalc .windowsill-line .worktop-comp__relative{
      height: 301px;
      top: 25%;
      padding-left: 60px;
   }
   .freecalc .windowsill-line .w1{
      left: 89.6%;
      top: 46%;
   }
   .freecalc .windowsill-line .l1{
      left: 41.8%;
      top: 86.5%;
   }

   /* Подоконник г-образный*/
   .freecalc .windowsill-g .worktop-comp__relative{
      height: 366px;
      top: 15%;
   }
   .freecalc .windowsill-g .w1{
      top: 82%;
      left: 7.5%;
   }
   .freecalc .windowsill-g .w2{
      top: 34%;
      left: 88.5%;
   }
   .freecalc .windowsill-g .l1{
      top: 25.5%;
      left: 10%;
   }
   .freecalc .windowsill-g .l2{
      top: 0%;
      left: 52%;
   }

   /* Подоконник зеркальный*/
   .freecalc .windowsill-mirrored .worktop-comp__relative{
      height: 356px;
      top: 25%;
   }
   .freecalc .windowsill-mirrored .w1{
      top: 82.5%;
      left: 7.5%;
   }
   .freecalc .windowsill-mirrored .w2{
      top: 35%;
      left: 45%;
   }
   .freecalc .windowsill-mirrored .w3{
      top: 82.5%;
      left: 88.5%;
   }
   .freecalc .windowsill-mirrored .l1{
      top: 26.5%;
      left: 9.8%;
   }
   .freecalc .windowsill-mirrored .l2{
      top: 0.7%;
      left: 47%;
   }
   .freecalc .windowsill-mirrored .l3{
      top: 26%;
      left: 85%;
   }

   .freecalc .freecalc-lasttext{
      margin-top: 20px;
   }
</style>