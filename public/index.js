const modal = document.getElementById("modal");

const CloseModal = (action = null) => {
    console.log(action)
    if(action){
        action()
    }
    modal.close()
}

const SimpleModal = (text, action) => {
    modal.innerHTML = `
    <div>
    <h1>${text}</h1>
    <div role="group" >
        <button id="cancel" onclick="CloseModal()"  type="reset">Cancel</button>
        <button id="confirm" onclick="CloseModal(${action})"  type="submit">Confirm</button>
    </div>
    </div>
    `
    modal.showModal()
}
