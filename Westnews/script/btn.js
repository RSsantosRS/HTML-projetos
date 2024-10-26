let image = document.getElementById('noticia-image')
let titulo = document.getElementById('noticia-titulo')
let p = document.getElementById('noticia-p')
let link = document.getElementById('noticia-link')

document.getElementById('btnNoticia').addEventListener('click', function(){
   image.style.backgroundImage = "url('../imgs/alunos.jpg')"
   image.style.backgroundRepeat = "no-repeat"
   image.style.backgroundSize = "cover"
   titulo.innerText = "Portal Estácio Singular"
   p.innerText = "Embora haja ajustes a serem feitos, a iniciativa caminha para transformar a maneira como os alunos vivenciam e gerenciam seus estudos, preparando-os de forma mais eficiente para os desafios do mercado de trabalho e da vida profissional."
   link.href = "portal-singular.html"
})