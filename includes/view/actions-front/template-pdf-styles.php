
<style>
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
	.header{
		margin-bottom: 60px;
	}
	.header td{
		background: #393939;
		height: 90px;
		width: 33.33333%;
		vertical-align: middle;
		color: #fff;
		padding: 15px;
	}
	.header td:last-child{
		text-align: right;
		width: 40%;
	}
	.header td p{
		font-size: 12px;
	}


	/* Шапка калькулятора */
	.calculation-header{
		margin-bottom: 40px;
	}
	h2{
		font-weight: normal;
		font-size: 18px;
		margin: 0;
		text-transform: uppercase;
	}

	/* Расчет */
	.calculation tr td{
		width: 20%;
		border-bottom: 1px solid #393939;
		padding: 8px 0;
		margin: 0;
	}
	.calculation tr:first-child td:last-child{
		width: 40%;
	}
	.calculation tr td:first-child{
		width: 60%;
	}
	.calculation tr td:last-child{
		text-align: right;
	}

	/* Total */
	.total{
		text-align: right;
		margin-top: 30px;
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
        margin-top: 50px;
		width: 960px;
        height: 340px;
		/*border: 1px solid red;*/
	}
    .worktop.worktop-line{
        height: 180px;
    }
	.worktop img{
        max-height: 400px;
        display: block;
        position: absolute;
        top: 0;
        left: 0;
    }
	.worktop span{
		position: absolute;
		display: block;
		width: 17px;
		height: 17px;
		border: 1px solid #E6340D;
	}
	.worktop span.checked{
		background: #9F0E05;
	}
    .worktop .size{
        min-width: 50px;
        height: 23px;
        border: none;
    }

    /* Прямая столешница */
    .worktop-line .check-mark-1{
        top: 111px;
        left: 154px;
    }
    .worktop-line .check-mark-2{
        top: -5px;
        left: 154px;
    }
    .worktop-line .check-mark-3{
        top: -5px;
        left: 610px;
    }
    .worktop-line .check-mark-4{
        top: 111px;
        left: 610px;
    }
    .worktop-line .check-panel {
        top: 53px;
        left: 196px;
    }
    /*  */
    .worktop-line .w1{
        top: 51px;
        left: 696px;
    }
    .worktop-line .l1{
        top: 135px;
        left: 362px;
    }


    /*--- Г-образная --*/
    .worktop-g .check-radial,
    .worktop-g .check-panel{
        width: 14px;
        height: 14px;
    }
    .worktop-g .size{
        font-size: 12px;
        height: 19px;
    }
    .worktop-g .check-mark-1{
        top: 166px;
        left: 147px;
    }
    .worktop-g .check-mark-2{
        top: 60px;
        left: 145px;
    }
    .worktop-g .check-mark-3{
        top: 60px;
        left: 572px;
    }
    .worktop-g .check-mark-4{
        top: 328px;
        left: 571px;
    }
    .worktop-g .check-mark-5{
        top: 328px;
        left: 464px;
    }
    .worktop-g .check-panel{
        top: 152px;
        left: 240px;
    }
    /* number-width */
    .worktop-g .w1{
        top: 108px;
        left: 39px;
    }
    .worktop-g .w2{
        top: 375px;
        left: 510px;
    }
    .worktop-g .l1{
        top: 0px;
        left: 349px;
    }
    .worktop-g .l2{
        top: 191px;
        left: 664px;
    }

    /* p - образная столешница */
    .worktop-p .check-mark-1{
        top: 260px;
        left: 145px;
    }
    .worktop-p .check-mark-2{
        top: 60px;
        left: 145px;
    }
    .worktop-p .check-mark-3{
        top: 60px;
        left: 572px;
    }
    .worktop-p .check-mark-4{
        top: 328px;
        left: 571px;
    }
    .worktop-p .check-mark-5{
        top: 328px;
        left: 464px;
    }
    .worktop-p .check-mark-6{
        top: 261px;
        left: 252px;
    }
    .worktop-p .check-panel{
        top: 152px;
        left: 240px;
    }
    /* number-width */
    .worktop-p .w1{
        top: 114px;
        left: 335px;
    }
    .worktop-p .w2{
        top: 307px;
        left: 190px;
    }
    .worktop-p .w3{
        top: 375px;
        left: 510px;
    }
    .worktop-p .l1{
        top: 0px;
        left: 349px;
    }
    .worktop-p .l2{
        top: 155px;
        left: 40px;
    }
    .worktop-p .l3{
        top: 191px;
        left: 664px;
    }

</style>