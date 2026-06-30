//JS logic for user

//common vars
const token = document.querySelector("meta[name='csrf-token']").getAttribute('content'); //csrf token for post operation
const notifBlock = document.getElementById('msg'); //notification block for user
const editProfileFormId = 'editProfileForm';

//load page
document.addEventListener('DOMContentLoaded', () => {
    const userId = document.getElementById('userId').value; //take user id from hidden input
    editProfile(userId, notifBlock);
});

function editProfile(userId, notifBlock) {
    const formBlock = document.getElementById(`${editProfileFormId}`);
    if(!formBlock) return;

    formBlock.addEventListener("submit", async (e) => {
        e.preventDefault(); //stop refresh

        //switch off submit btn
        const submitBtnControl = document.querySelector('[type="submit"]');
        submitBtnControl.disabled = true;

        try {
            //get data from form
            const form = e.target;
            const formData = new FormData(form);

            //make request to server
            const req = await fetch(`/users/${userId}`, {
                method: 'PATCH',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': token
                },
                body: formData
            });

            const res = await req.json();

            //msg for user
            if(!notifBlock) return;

            if (!req.ok) {
                notifBlock.innerHTML = `<p style="color:red">${Object.values(res.msg)[0][0]}</p>`;
                return;
            }
            
            if(res.status === 'ok') {
                formBlock.reset(); //reset form

                notifBlock.innerHTML = `<p style="color:green">Юзер обновлён успешно</p>`;
            } else {
                notifBlock.innerHTML = `<p style="color:red">Error on server.</p>`;
            }
        } catch (err) {
            console.log(err);
        } finally {
            //switch on button
            submitBtnControl.disabled = false;
        }
    });
}