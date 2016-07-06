package grafos.anexoParciales;

import grafos.*;
import tp03.ejercicio8.ListaEnlazadaGenerica;
import tp03.ejercicio8.ListaGenerica;

public class Ejercicio1{
	public ListaEnlazadaGenerica<String> caminoConMenorNrodeViajes(Grafo<String> grafo, String puntoInteresOrigen, String puntoInteresDestino){
		boolean[] marca = new boolean[grafo.listaDeVertices().tamanio()+1];
		ListaGenerica<Vertice<String>> vertices = grafo.listaDeVertices();
		ListaEnlazadaGenerica<Vertice<String>> resultado = new ListaEnlazadaGenerica<>();
		ListaEnlazadaGenerica<Vertice<String>> caminoActual = new ListaEnlazadaGenerica<>();
		Vertice<String> origen = buscarVertice(puntoInteresOrigen, grafo);
		Vertice<String> destino = buscarVertice(puntoInteresDestino, grafo);
		this.dfs(grafo,origen,destino,caminoActual,resultado,Integer.MAX_VALUE,Integer.MIN_VALUE,marca);
		ListaEnlazadaGenerica<String> fin = transformar(resultado);
		return fin;
	}
	
	private ListaEnlazadaGenerica<String> transformar(ListaEnlazadaGenerica<Vertice<String>> entrada){
		ListaEnlazadaGenerica<String> resultado = new ListaEnlazadaGenerica<>();
		entrada.comenzar();
		while(!entrada.fin()){
			resultado.agregarFinal(entrada.proximo().dato());
		}
		return resultado;
	}
	
	private void dfs (Grafo<String> grafo, Vertice<String> origen, Vertice<String> destino, ListaEnlazadaGenerica<Vertice<String>> caminoActual,ListaEnlazadaGenerica<Vertice<String>> resultado, Integer pesomin, Integer maximo, boolean[] marca){
		marca[origen.posicion()]=true;
		caminoActual.agregarFinal(origen);
		if(!origen.equals(destino)){
			ListaGenerica<Arista<String>> adyacentes = grafo.listaDeAdyacentes(origen);
			adyacentes.comenzar();
			while(!adyacentes.fin()){
				Arista<String> a = adyacentes.proximo();
				int k=Math.max(pesomin, a.peso());
				dfs(grafo,a.verticeDestino(),destino,caminoActual,resultado,k,maximo,marca);
			}
		}else{
			if(pesomin>maximo){
				maximo=pesomin;
				actualizar(resultado,caminoActual);
			}
		}
		caminoActual.eliminar(origen);
		marca[origen.posicion()]=false;
	}
	
	private void actualizar(ListaEnlazadaGenerica<Vertice<String>> resultado, ListaEnlazadaGenerica<Vertice<String>> caminoActual){
		while(!resultado.esVacia()){
			resultado.eliminarEn(1);
		}
		caminoActual.comenzar();
		while(!caminoActual.fin()){
			resultado.agregarFinal(caminoActual.proximo());
		}
	}
}
