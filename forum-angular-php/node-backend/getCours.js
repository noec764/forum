const queries = require('./mysqlQuery');
const {sendError, sendMessage} = require("./message");
const auth = require('./auth');


async function getCours(req, res) {
    console.log(req.cookies);
    const session = auth.getSession(req);
    console.log(session);
    const idUtilisateur = auth.getUserId(session);
    if (idUtilisateur < 0) {
        return (sendError(res,"Pas connecte"));
    }
    auth.setSessionCookie(req, res, session);

    const getCoursUser = await queries.getCoursUser(idUtilisateur);
    sendMessage(res, getCoursUser);

}

module.exports = getCours;