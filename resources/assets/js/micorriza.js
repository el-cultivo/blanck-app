import {ifElementExistsThenLaunch} from './functions/dom';
import {w} from './cltvo/constants.js';

w.on('load', () => {
	ifElementExistsThenLaunch([
		[]
	]);
});


//cosas relacionadas únicamente con la version de desarrollo
if (process.env.NODE_ENV ==='webpack') { window.CLTVO_ENV = 'webpack'} //corre en modo webpack, necesario para hacer HMR
if (module.hot) { module.hot.accept(); }//permite hacer Hot Module Replacement 