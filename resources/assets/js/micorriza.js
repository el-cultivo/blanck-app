import {ifElementExistsThenLaunch} from './functions/dom';
import {w} from './cltvo/constants.js';
import {alertsController} from './alerts-controller';

w.on('load', () => {
	ifElementExistsThenLaunch([
		['#alert__container', alertsController, 'init', []],
	]);
	alerts;
});
