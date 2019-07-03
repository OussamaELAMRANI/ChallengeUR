import Cookies from 'js-cookie';

const TokenKey = 'challenge-token';
const TokenTime = 'challenge-Time';

export function getToken() {
	return Cookies.get(TokenKey);
}

export function getExpireTime() {
	return Cookies.get(TokenTime);
}

export function setToken(token) {
	return Cookies.set(TokenKey, token);
}

export function removeToken() {
	return Cookies.remove(TokenKey);
}

export function expireToken(time) {
	return Cookies.set(TokenTime, time);
}
