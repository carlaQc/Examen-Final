// var imagenes = ['../../../../../profile/login-bg.jpg','../../../../../profile/1588888698_94715c463-1.jpg','../../../../../profile/1581607897_Unifranz.png'],
// 	cont = 0;
// function carrousel(image){
// 	alert('olsld');
// 	image.addEventListener('click',e =>{
// 		let back = image.querySelector('.back'),
// 			next = image.querySelector('.next'),
// 			img = image.querySelector('img'),
// 			tgt = e.target;

// 		if(tgt == back){
// 			if(cont > 0){
// 				img.src = imagenes[cont -1];
// 				cont--;
// 			}else{
// 				img.src = imagenes[imagenes.length - 1];
// 				cont = imagenes.length - 1;
// 			}
// 		} else if (tgt == next) {
// 			if(cont < imagenes.length - 1){
// 				img.src = imagenes[cont +1];
// 				cont++;
// 			}else{
// 				img.src = imagenes[0];
// 				cont = 0;
// 			}
// 		}
// 	});
// }

// document.addEventListener("DOMContentLoader",()=>{
// 	let image = document.querySelector('.image');
// 	carrousel(image);
// });
var num=1;
function adelante(){
	num++;
	if(num>3){
		num=1;
	var foto=document.getElementById("foto");
	foto.src="foto"+num+".jpg";
	}
}
function atras(){
	num--;
	if(num<1){
		num=3;
	var foto=document.getElementById("foto");
	foto.src="foto"+num+".jpg";
	}
}