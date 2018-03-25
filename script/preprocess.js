var markedpp = require('markedpp');

module.exports = (m,o) => {
return new Promise((resolve,reject)=>{
    markedpp(m,(err,md) => {
        if (err) return reject(err);
        resolve(md);
    });
});
};
