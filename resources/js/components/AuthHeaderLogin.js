export default function authSenderHeader(type = '') {
    let Token;

    if (type === 'Sender') {
        Token = JSON.parse(localStorage.getItem('senderToken'));
    }
    else {
        Token = JSON.parse(localStorage.getItem('bikerToken'));
    }

    if (Token) {
        return {Authorization: 'Bearer ' + Token};
    } else {
        return {};
    }
}
