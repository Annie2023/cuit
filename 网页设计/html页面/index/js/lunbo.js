let left =document.querySelector(".button-left")
let right=document.querySelector(".button-right")
let m=document.querySelectorAll(".m")
let images=document.querySelector(".images")

let index=0
let time
function position(){
    images.style.left=(index * -100)+"%"
    setCircle(index)
}

function add(){
    if(index>=m.length-1){
        index=0
    }
    else{
        index++
    }
}

function desc(){
    if(index<1){
        index=m.length-1
    }
    else{
        index--
    }
}

function timer(){
    time=setInterval(()=>{
        index++
        desc()
        add()
        position()
    },3000)
}

left.addEventListener("click",()=>{
    desc()
    position()
    clearInterval(time)
    timer()
})

right.addEventListener("click",()=>{
    add()
    position()
    clearInterval(time)
    timer()
})

function setCircle(i){
    if (i === index) {
        m[i].classList.add("active");
    }
        for(let i=0;i<m.length;i++){
            if(i!==index){
                m[i].classList.remove("active");
            }
        }
}
for(let i=0;i<m.length;i++){
    m[i].addEventListener("click",()=>{
        index=i
        position()
        clearInterval(time)
        timer()
    })
}

timer()