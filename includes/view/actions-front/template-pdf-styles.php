
<style>
   @page{margin: 0.12in 0.36in 0.1in 0.2in;}
	*{
		font-family: Arial, sans-serif;
	}
	table{
		width: 100%;
		border-collapse: collapse;
	}
	table p{
		margin: 0;
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


	/* Шапка документа */
    a{
        text-decoration: none !important;
       color: #000 !important;
    }
	.header{
      bottom: 0;
      position: relative;
      z-index: 100;
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
	}
	.header td:last-child{
		text-align: right;
	}
	.header td p{
	}

	/* Расчет */
    .detailing-header{
      font-size: 20px;
      font-weight: normal;
      margin-bottom: 10px;
      margin-left: 40px;
       text-transform: uppercase;
       position: relative;
       z-index: 100;
       /*background: #fff;*/
       display: inline-block;
    }
	.detailing{
      margin-bottom: 10px;
   }
	.detailing th{
      text-align: center;
      font-size: 13px;
      background: #B59293;
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
	}
    .detailing tr td:first-child{
        width: 40px;
       text-align: center;
    }
   .detailing tr td:last-child{
      width: 110px;
      text-align: center;
   }

   .detailing tr:nth-child(even) td{
      background: #FCDFDE;
   }
   .detailing tr td:nth-last-child(3){
      width: 110px;
      text-align: center;
   }

        /* Total */
	.total{
		text-align: right;
		display: block;
	}
	.total > *{
		vertical-align: middle;
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
	}
	.to-lower{
		text-transform: lowercase;
	}

    /*-------------- Чеки на столешнице -------------*/
	.worktop{
      display: block;
      position: relative;
      width: 688px;
      height: 250px;
      margin-left: auto;
      margin-right: auto;
		/*border: 1px solid red;*/
	}
   .worktop.worktop-g,
   .worktop.worktop-p{
      height: 380px;
      margin-top: -40px;
      margin-bottom: -50px;
   }
    .worktop.worktop-line{
       height: 200px;
       margin-top: 50px;
    }

   .worktop.windowsill-mirrored,
   .worktop.windowsill-g{
      height: 300px;
   }

	.worktop img{
         width: 688px;
        max-height: 400px;
        display: block;
        position: absolute;
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


    /*--- Г-образная --*/
    .worktop-g .size{
        font-size: 12px;
        height: 19px;
    }
    .worktop-g .check-mark-1{
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
    /* number-width */
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
    }

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