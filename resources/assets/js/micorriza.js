import {ifElementExistsThenLaunch} from './functions/dom';
import {w} from './cltvo/constants.js';

w.on('load', () => {
	ifElementExistsThenLaunch([
		['#alert__container', alertsController, 'init', []],
	]);
});