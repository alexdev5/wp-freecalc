
<style>
   @page{margin: 0}
	*{
      /*font-family: 'Open Sans', sans-serif;*/
      font-family: 'PT Sans Caption', sans-serif;
      font-weight: 400;
	}
	table{
		width: 100%;
		border-collapse: collapse;
	}
	table p{
		margin: 0;
        font-family: Arial, sans-serif !important;
	}
	table h2{
		font-weight: normal;
		font-size: 18px;
		margin: 0;
	}
	small{
		font-size: 60%;
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
    .b-red{
        border: 1px solid red;
    }


	/* Шапка документа <table>*/
    a{
        text-decoration: none !important;
       color: #000 !important;
    }
	.header{
        position: fixed;
        top: -130px;
        left: 0;
        z-index: 100;
        margin: 0;
        border: 1px solid red;
	}
   .footer{
       background: #18164A;
       position: fixed;
       bottom: -50px;
       left: 0;
       width: 100%;
       height: 50px;
       border: 1px solid red;
   }

   .wrapper{
       padding-left: 10px;
       padding-right: 10px;
   }
   .header-text{
       text-align: center;
       font-size: 20px;
       font-weight: 500;
       position: relative;
       z-index: 100;
       border: 1px solid red;
       margin: 0;
       margin-bottom: 20px;
       padding: 0;
   }
   .text-after-calc{
       padding-left: 30px;
       margin-top: 30px;
   }

    .header .logo{
        vertical-align: middle;
    }
    .header .logo-img{
        width: 50px;
        vertical-align: middle;
    }
   .header .logo-img img{
      width: 50px;
   }
    .header .logo-text{
        font-size: 24px;
        color: #000;
        font-weight: 700;
        vertical-align: middle;
    }
    .header .logo small{
        color: #163CAD;
        display: block;
        margin-left: 60px;
        font-weight: 500;
    }
    .logo span{
        display: inline-block;
    }
	.header td{
		height: 90px;
		width: 50%;
		vertical-align: middle;
		padding: 15px;
     font-size: 14px;
        font-family: Arial, sans-serif !important;
	}
	.header td:last-child{
		text-align: right;
	}
	.header td p{
	}

    .detail-add{
        border: 1px solid red;
        text-align: center;/*
        margin-left: auto;
        margin-right: auto;*/
    }
   /*.detail-add div{
       display: inline-block;
       margin-right: 20px;
       border: 1px solid red;
   }*/
   .detail-add td{
      text-align: center;
   }
   .detail-add > div:last-child{
       margin-right: 0;
   }
   .detail-add .detail-add__text{
       text-align: center;
   }
   .detail-add .detail-add__block{
      height: 180px;
      width: 180px;
      border: 1px solid red;
      position: relative;
      margin-left: auto;
      margin-right: auto;
   }
   .detail-add__block img {
      max-width: 100%;
      height: auto;
   }
   .detail-add__block .add-img{
      border: 1px solid red;
      width: 100%;
      text-align: center;
       position: absolute;
      top: 50%;
      transform: translateY(-50%);
       margin: auto;
       max-width: 140px;
       max-height: 89px;
   }
   .detail-add__block .add-text{
      border: 1px solid red;
      width: 100%;
       position: absolute;
      top: 140px;
       text-align: center;
   }
	/* Расчет */
    .detailing-header{
      font-size: 20px;
      font-weight: normal;
      margin-bottom: 10px;
       position: relative;
       z-index: 100;
       /*background: #fff;*/
        text-align: center;
    }
	.detailing{
      margin-bottom: 10px;
   }
	.detailing th{
      text-align: center;
      font-size: 13px;
      background: #FFE699;
      vertical-align: middle;
      text-transform: none;
      padding: 0;
      font-weight: 500;
    }
	.detailing td{
		margin: 0;
      font-size: 14px;
      font-weight: 500;
      padding: 1px 3px;
      vertical-align: middle;
	}
   .detailing td:first-child{
      text-align: center;
   }

        /* Total */
	.total{
      margin: 0;
   }
	.total td{
      background: #FFE699;
      vertical-align: middle;
      padding-left: 10px !important;
      padding-right: 10px !important;
   }
	.total h2{
		display: inline-block;
		font-size: 32px;
		font-weight: 500;
	}
	.total .total-sum{
		font-size: 32px;
		font-weight: 500;
		margin-left: 30px;
      text-align: right;
	}
	.to-lower{
		text-transform: lowercase;
	}

    /*-------------- Чеки на столешнице -------------*/
   .bd-red{
       border: 1px solid red;
   }
   .worktop-static{
       border: 1px solid red;
   }
	.worktop{
      display: block;
      position: relative;
      width: 688px;
        height: 343px;
      margin-left: auto;
      margin-right: auto;
      border: 1px solid #E6340D;
	}
   .worktop h3{
      position: relative;
      z-index: 100;
      margin: 0;
   }

	.worktop img{
      /*width: 688px;
		 max-height: 400px;*/
        display: block;
        position: absolute;
      border: 1px solid #E6340D;
        top: 0;
        left: 0;
    }
	.worktop span{
		position: absolute;
		display: block;
		width: 14px;
		height: 14px;
		border: 1px solid #E6340D;
	}
	.worktop span.checked{
		background: red;
	}
   .worktop .size{
        min-width: 50px;
        height: 23px;
        border: none;
    }

    /* Прямая столешница */
    .worktop-line .check-mark-1{
        top: 98px;
        left: 139px;
    }
    .worktop-line .check-mark-2{
        top: -3px;
        left: 139px;
    }
    .worktop-line .check-mark-3{
        top: -3px;
        left: 541px;
    }
    .worktop-line .check-mark-4{
        top: 98px;;
        left: 542px;
    }
    .worktop-line .check-panel {
        top: 47px;
        left: 174px;
    }
    /*  */
    .worktop-line .w1{
        top: 44px;
        left: 619px;
    }
    .worktop-line .l1{
        top: 118px;
        left: 320px;
    }


   /* Г - образная столешница */
   /*--- Г-образная --*/
   .worktop-g .size{
      font-size: 12px;
      height: 19px;
   }
   .worktop-g .check-mark-1{
      top: 42%;
      left: 20%;
   }
   .worktop-g .check-mark-2{
      top: 77px;
      left: 190px;
   }
   .worktop-g .check-mark-3{
      top: 14.5%;
      right: 19%;
   }
   .worktop-g .check-mark-4{
      bottom: 13.4%;
      right: 19%;
   }
   /* wprice-panel */
   .worktop-g .check-mark-5{
      bottom: 13.5%;
      right: 34.2%;
   }
   /* check-stone */
   .worktop-g .check-mark-6{
      top: 38%;
      left: 33.2%;
   }
   .worktop-g .check-mark-7{
      top: 30.1%;
      left:58.5%
   }
   /* check-washing */
   .worktop-g .check-mark-8{
      top: 38%;
      left: 33.1%;
   }
   /* number-width */
   .worktop-g .w1{
      top: 26.7%;
      left: 5%;
   }
   .worktop-g .w2{
      bottom: 0.2%;
      right: 23.8%;
   }
   /*  */
   .worktop-g .l1{
      top: 0.2%;
      right: 46%;
   }

   .worktop-g .l2{
      top: 47.7%;
      right: 2.7%;
   }

    /* .worktop-g .check-mark-1{
        top: 158px;
        left: 138px;
    }
    .worktop-g .check-mark-2{
        top: 57px;
        left: 138px;
    }
    .worktop-g .check-mark-3{
        top: 57px;
        left: 541px;
    }
    .worktop-g .check-mark-4{
        top: 311px;
        left: 541px;
    }
    .worktop-g .check-mark-5{
        top: 311px;
        left: 441px;
    }
    .worktop-g .check-panel{
        top: 145px;
        left: 229px;
    }
    !* number-width *!
    .worktop-g .w1{
        top: 102px;
        left: 36px;
    }
    .worktop-g .w2{
        top: 356px;
        left: 486px;
    }
    .worktop-g .l1{
        top: 0;
        left: 332px;
    }
    .worktop-g .l2{
        top: 181px;
        left: 630px;
    }*/

    /* p - образная столешница */
    .worktop-p .check-mark-1{
        top: 246px;
        left: 139px;
    }
    .worktop-p .check-mark-2{
        top: 57px;
        left: 138px;
    }
    .worktop-p .check-mark-3{
        top: 57px;
        left: 541px;
    }
    .worktop-p .check-mark-4{
        top: 311px;
        left: 541px;
    }
    .worktop-p .check-mark-5{
        top: 311px;
        left: 441px;
    }
    .worktop-p .check-mark-6{
        top: 246px;
        left: 239px;
    }
    .worktop-p .check-panel{
        top: 145px;
        left: 229px;
    }
    /* number-width */
    .worktop-p .w1{
        top: 107px;
        left: 320px;
    }
    .worktop-p .w2{
        top: 289px;
        left: 182px;
    }
    .worktop-p .w3{
        top: 354px;
        left: 483px;
    }
    .worktop-p .l1{
        top: 0;
        left: 331px;
    }
    .worktop-p .l2{
        top: 147px;
        left: 38px;
    }
    .worktop-p .l3{
        top: 180px;
        left: 629px;
    }


   /* Столешница в ванную */
   .worktop-bathroom{

   }
   .worktop-bathroom .w1{
      top: 22px;
      left: 630px;
   }
   .worktop-bathroom .l1{
      left: 256px;
      top: 115px;
   }

   /* Подоконник прямой*/
   .windowsill-line .w1{
      left: 630px;
      top: 103px;
   }
   .windowsill-line .l1{
      top: 196px;
      left: 256px;
   }

   /* Подоконник г-образный (Угловой)*/
   .windowsill-g .w1{
      top: 227px;
      left: 34px;
   }
   .windowsill-g .w2{
      top: 95px;
      left: 625px;
   }
   .windowsill-g .l1{
      top: 71px;
      left: 50px;
   }
   .windowsill-g .l2{
      top: 0;
      left: 358px;
   }

   /* Подоконник зеркальный*/
   .windowsill-mirrored .w1{
      top: 222px;
      left: 34px;
   }
   .windowsill-mirrored .w2{
      top: 93px;
      left: 306px;
   }
   .windowsill-mirrored .w3{
      top: 222px;
      left: 625px;
   }
   .windowsill-mirrored .l1{
      top: 70px;
      left: 50px;
   }
   .windowsill-mirrored .l2{
      top: 0;
      left: 322px;
   }
   .windowsill-mirrored .l3{
      top: 69px;
      left: 600px;
   }
</style>