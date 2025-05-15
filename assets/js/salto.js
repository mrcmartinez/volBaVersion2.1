var letras=0;

function check(e) {	      
      tecla = (document.all) ? e.keyCode : e.which;
      if(tecla>32)
	      letras++;
      if(letras>40&&tecla==32){
        letras=0;
        document.getElementById("nota").value+='\n';
      }
      return true;
}