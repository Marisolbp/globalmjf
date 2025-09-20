/**
 * Funciones de creacion de elementos
 */

const __get_bubble = (pStrChat, pStrType) => {

    if (!['me', 'you'].includes(pStrType)) {
        throw 'Elemento no soportado'
    }

    let mNodoRow = document.createElement('div');
    let mAvatar = document.createElement('div');
    let mImgAvatar = document.createElement('img');
    let mNodoBubble = document.createElement('div');

    mNodoRow.classList.add('row_chat');
    mAvatar.classList.add('avatar_chat');
    mImgAvatar.classList.add('img_avatar');
    mNodoBubble.classList.add('bubble_chat');

    mAvatar.appendChild(mImgAvatar);

    mNodoBubble.textContent = pStrChat;


    if (pStrType === 'me') {
        mNodoRow.classList.add('chat_me');
        mImgAvatar.src = 'images/bot.svg'

        mNodoRow.appendChild(mAvatar);
        mNodoRow.appendChild(mNodoBubble);

    } else {
        mNodoRow.classList.add('chat_you');
        mImgAvatar.src = 'images/person.svg';

        mNodoRow.appendChild(mNodoBubble);
        mNodoRow.appendChild(mAvatar);
    }

    return mNodoRow;

}


const __get_response = (pStrChat, callback) => {
    let mObjData = {
        chat: pStrChat
    }

    $.post("./controller/chat.php", mObjData)
        .done(function(data) {
            try {
                let mData = data;
                callback(null, mData.response);
            } catch (error) {
                callback(error, null);
            }
        })
        .fail(function(error) {
            callback(error, null);
        });
}


/* ---------------------------------------------------
 * 
 *                Inicio de la logica
 * 
 * --------------------------------------------------- */

/**
 * Elementos del chat bot
 */
let mBtnBot  = document.getElementById('btn_bot');
let mElmChat = document.getElementById('element_chat_bot');
let mInpChat = document.getElementById('chat_input');
let mBtnSend = document.getElementById('btn_send_chat');
let mElmBody = document.getElementById('body_chat_bot');


/**
 * Eventos
 */
mBtnBot.addEventListener('click', ()=>{
    mElmChat.classList.toggle('close');
});

mBtnSend.addEventListener('click', ()=>{
    let mStrChat = mInpChat.value?.trim();

    if (!mStrChat) return;

    let mRow = __get_bubble(mStrChat, 'you');
    mElmBody.appendChild(mRow);

     mInpChat.value = '';

    __get_response(mStrChat, (error, response) => {
        if (error) {
            console.error('Error:', error);
            mRow = __get_bubble('Error al obtener respuesta', 'me');
        } else {
            mRow = __get_bubble(response, 'me');
        }
        mElmBody.appendChild(mRow);
    });
});

mInpChat.addEventListener('keypress', (e) => {
    if (e.key === 'Enter') {
        mBtnSend.click();
    }
});