const auth = require ('./auth');
const queries = require('./mysqlQuery');
const message = require("./message");

async function checkLogin(req,res){

    if(typeof req.body.login === 'undefined')
        return message.sendError(res,"Vous n'avez pas envoyé le login");
    if(typeof req.body.password === 'undefined')
        return message.sendError(res,"Vous n'avez pas envoyé le mot de passe");

    const id = await queries.checkLoginSes(req.body.login,req.body.password);

    if (typeof id[0] !== 'undefined') {
        if (id[0]['idUtilisateur'] > 0) {
            const payload = {userId: id[0]['idUtilisateur']}
            console.log(payload);
            auth.setSessionCookie(req, res, payload);
            message.sendMessage(res, "");
        } else message.sendError(res, "login/password invalide")
    } else message.sendError(res, "login/password invalide")
}

module.exports = checkLogin;