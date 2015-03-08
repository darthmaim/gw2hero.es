let helper = {
    modulo: ( a, b ) => (+a % (b = +b) + b) % b,
    log: ( msg, ...extra ) => console.log( '[GW2Heroes] ' + msg, ...extra )
};
export default helper;
