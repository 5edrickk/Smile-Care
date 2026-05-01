function confirm(env) {
    let con = document.getElementById('confirmation');
    let yesBtn = document.getElementById('btnOui');
    let noBtn = document.getElementById('btnNon');

    let btnValue = env.currentTarget.value;

    con.classList.remove('hidden');
    yesBtn.addEventListener('click', function (){
        window.location.href = 'http://localhost/utilisateurDelete/' + btnValue;
    });

    noBtn.addEventListener('click', function (){
        con.classList.add('hidden');
    });
}

let deleteBtns = document.getElementsByClassName('deleteBtn');

for(let i = 0; i < deleteBtns.length; i++) {
    deleteBtns[i].addEventListener('click', confirm);
}
