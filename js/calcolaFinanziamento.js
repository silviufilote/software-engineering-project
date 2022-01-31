function datiForm(){
				// 12 mesi
				if (document.getElementById('mesi1').checked) {
					document.getElementById("datiAnticipo1").innerHTML = Number(document.getElementById("valore").innerText * 0).toFixed(2);
					document.getElementById("datiAnticipo2").innerHTML = Number(document.getElementById("valore").innerText * 0.20 * 0.10).toFixed(2);
					document.getElementById("datiAnticipo3").innerHTML = Number(document.getElementById("valore").innerText * 0.20 * 0.20).toFixed(2);
					document.getElementById("datiAnticipo4").innerHTML = Number(document.getElementById("valore").innerText * 0.20 * 0.30).toFixed(2);
				}
				// 24 mesi
				if (document.getElementById('mesi2').checked) {
					document.getElementById("datiAnticipo1").innerHTML = Number(document.getElementById("valore").innerText * 0).toFixed(2);
					document.getElementById("datiAnticipo2").innerHTML = Number(document.getElementById("valore").innerText * 0.34 * 0.10).toFixed(2);
					document.getElementById("datiAnticipo3").innerHTML = Number(document.getElementById("valore").innerText * 0.34 * 0.20).toFixed(2);
					document.getElementById("datiAnticipo4").innerHTML = Number(document.getElementById("valore").innerText * 0.34 * 0.30).toFixed(2);
				}
				// 36 mesi
				if (document.getElementById('mesi3').checked) {
					document.getElementById("datiAnticipo1").innerHTML = Number(document.getElementById("valore").innerText * 0).toFixed(2);
					document.getElementById("datiAnticipo2").innerHTML = Number(document.getElementById("valore").innerText * 0.37 * 0.10).toFixed(2);
					document.getElementById("datiAnticipo3").innerHTML = Number(document.getElementById("valore").innerText * 0.37 * 0.20).toFixed(2);
					document.getElementById("datiAnticipo4").innerHTML = Number(document.getElementById("valore").innerText * 0.37 * 0.30).toFixed(2);
				}
				// 48 mesi
				if (document.getElementById('mesi4').checked) {
					document.getElementById("datiAnticipo1").innerHTML = Number(document.getElementById("valore").innerText * 0).toFixed(2);
					document.getElementById("datiAnticipo2").innerHTML = Number(document.getElementById("valore").innerText * 0.45 * 0.10).toFixed(2);
					document.getElementById("datiAnticipo3").innerHTML = Number(document.getElementById("valore").innerText * 0.45 * 0.20).toFixed(2);
					document.getElementById("datiAnticipo4").innerHTML = Number(document.getElementById("valore").innerText * 0.45 * 0.30).toFixed(2);
				}
		}



		function finanziamento() {
				var tipo;
				var prezzo;

				if (document.getElementById('tipo1').checked) {
					tipo = document.getElementById('tipo1').value;
				}
				if (document.getElementById('tipo2').checked) {
					tipo = document.getElementById('tipo2').value;
				}

				var mese;
				if (document.getElementById('mesi1').checked) {
					mese = document.getElementById('mesi1').value;
					prezzo  = Number(document.getElementById("valore").innerText * 0.20).toFixed(2)
				}
				if (document.getElementById('mesi2').checked) {
					mese = document.getElementById('mesi2').value;
					prezzo  = Number(document.getElementById("valore").innerText * 0.34).toFixed(2)
				}
				if (document.getElementById('mesi3').checked) {
					mese = document.getElementById('mesi3').value;
					prezzo  = Number(document.getElementById("valore").innerText * 0.37).toFixed(2)
				}
				if (document.getElementById('mesi4').checked) {
					mese = document.getElementById('mesi4').value;
					prezzo  = Number(document.getElementById("valore").innerText * 0.45).toFixed(2)
				}

				var chilometraggio;
				if (document.getElementById('km1').checked) {
					chilometraggio = document.getElementById('km1').value;
				}
				if (document.getElementById('km2').checked) {
					chilometraggio = document.getElementById('km2').value;
				}
				if (document.getElementById('km3').checked) {
					chilometraggio = document.getElementById('km3').value;
				}
				if (document.getElementById('km4').checked) {
					chilometraggio = document.getElementById('km4').value;
				}
				if (document.getElementById('km5').checked) {
					chilometraggio = document.getElementById('km5').value;
				}
				if (document.getElementById('km6').checked) {
					chilometraggio = document.getElementById('km6').value;
				}

				var anticipo;
				if (document.getElementById('anticipo1').checked) {
					anticipo = Number(document.getElementById('datiAnticipo1').innerText).toFixed(2);
				}
				if (document.getElementById('anticipo2').checked) {
					anticipo = Number(document.getElementById('datiAnticipo2').innerText).toFixed(2);
				}
				if (document.getElementById('anticipo3').checked) {
					anticipo = Number(document.getElementById('datiAnticipo3').innerText).toFixed(2);
				}
				if (document.getElementById('anticipo4').checked) {
					anticipo = Number(document.getElementById('datiAnticipo4').innerText).toFixed(2);
				}

                var brand = document.getElementById("datiBrand").innerText;
				var modello = document.getElementById("datiModello").innerText;
				var versione = document.getElementById("datiVersione").innerText;

				if(tipo && mese && chilometraggio && anticipo && brand && modello && versione && prezzo){
				window.location.href = "https://avoc.altervista.org/riepilogo.php?tipo="+tipo+"&brand="+brand+"&modello="+modello+"&versione="+versione+"&prezzo="+prezzo+"&mese="+mese+"&chilometraggio="+chilometraggio+"&anticipo="+anticipo;
				}else {
					alert("Errore dati incompleti");
				}
            }
