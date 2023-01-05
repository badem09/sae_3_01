/*
        logiciel libre sous licence MIT
        auteur: Alain Busser
        date: 27 mai 2013
        source : https://irem.univ-reunion.fr/IMG/html/normales.html
        */

        var coef=Math.sqrt(2*Math.PI);

        function arrondi(x,e){
            var p10=Math.pow(10,e);
            return(Math.round(p10*x)/p10);
        }

        function arrondi_inf(x,e){
            var p10=Math.pow(10,e);
            return(Math.floor(p10*x)/p10);
        }

        function arrondi_sup(x,e){
            var p10=Math.pow(10,e);
            return(Math.ceil(p10*x)/p10);
        }


        function phi(x){
            return Math.exp(-x*x/2)/coef;
        }

        function erf(x){
            var t=1/(1+0.3275911*x);
            var ye=1.061405429;
            ye=ye*t-1.453152027;
            ye=ye*t+1.421413741;
            ye=ye*t-0.284496736;
            ye=ye*t+0.254829592;
            ye*=t;
            ye*=Math.exp(-x*x);
            return (1-ye);
        }

        function Pi(x){
            if(x<0){return(1-Pi(-x));} else {
                if(x<100){
                    return((1+erf(x/Math.SQRT2))/2);
                } else {
                    return(1);
                }
            }
        }

        function maj(){
            mu=parseFloat(document.getElementById('esp').value);
            sigma=Math.abs(parseFloat(document.getElementById('et').value));
            Xmin=Math.max(mu-100*sigma,parseFloat(- document.getElementById('t').value));
            Xmax=Math.min(mu+100*sigma,parseFloat(document.getElementById('t').value));
            a=(Xmin-mu)/sigma;
            b=(Xmax-mu)/sigma;
            odg=1-Math.round(Math.log(8*sigma)/Math.LN10);
            pdec=Math.pow(10,-odg);
            remplir2();

        }

        function remplir2(){
            var ctx2=document.getElementById('can2');
            if (ctx2.getContext){
                var ctx2=ctx2.getContext('2d');
                ctx2.fillStyle="White";
                ctx2.fillRect(0,0,400,240);
                ctx2.fillStyle="Lightgreen";
                ctx2.strokeStyle="Cyan";
                ctx2.beginPath();
                ctx2.moveTo(0,220);

                for(x=0;x<=Math.round(200+50*b);x++){
                    ctx2.lineTo(x,220-500*phi((x-200)/50));
                }

                ctx2.lineTo(200+50*b,220);
                ctx2.lineTo(0,220);
                ctx2.stroke();
                ctx2.fill();

                ctx2.strokeStyle="Red";
                ctx2.beginPath();
                ctx2.moveTo(0,220);

                for(x=1;x<=400;x++){
                    ctx2.lineTo(x,220-500*phi((x-200)/50));
                }

                ctx2.stroke();
                ctx2.strokeStyle="Blue";
                ctx2.fillStyle="Magenta";
                ctx2.beginPath();

                for(var xg=arrondi_sup(mu-4*sigma,odg);xg<arrondi_inf(mu+4*sigma,odg);xg=arrondi(xg+pdec,odg)){
                    x=(xg-mu)/sigma;
                    x=x*50+200;
                    ctx2.moveTo(x,220);
                    ctx2.lineTo(x,225);
                    ctx2.fillText(xg.toString(),x-5,235);
                }

                ctx2.moveTo(0,220);
                ctx2.lineTo(400,220);
                ctx2.stroke();
            }
        }