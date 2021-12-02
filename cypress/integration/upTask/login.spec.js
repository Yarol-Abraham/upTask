/// <reference types="cypress" />

describe('UpTask - Login', ()=>{

    beforeEach(()=>{ cy.visit('http://localhost:8080/upTask/auth/login'); })

    it('Revisar los elementos del formulario', () => {
        
        cy.get('.auth_input')
        .should('exist')
        .should('have.length', 2); // deben de existir dos inputs

        cy.get('[type="submit"]')
        .should('exist')
        .should('have.length', 1); // debe existir un boton de tipo submit

    });

    it('Revisar enlace de crear cuenta - enviar a la pagina esperada', ()=>{

        cy.get('[data-cy="link_create_account"]')
        .should('exist')
        .should('have.length', 1); // debe existir un boton de tipo submit

        cy.get('[data-cy="link_create_account"]').click()
        .then(()=>{
            cy.visit('http://localhost:8080/upTask/user/create'); // crear cuenta
        })
        
        cy.wait(2000);
        cy.go('back');

    });

    it('Revisar enlace de olvide mi contraseña - enviar a la pagina esperada', ()=>{

        cy.get('[data-cy="link_forgett_pass"]')
        .should('exist')
        .should('have.length', 1); // debe existir un boton de tipo submit

        cy.get('[data-cy="link_forgett_pass"]').click()
        .then(()=>{
            cy.visit('http://localhost:8080/upTask/auth/forgett'); // olvide mi contraseña
        })
        
        cy.wait(2000);
        cy.go('back');

    });

    it('Si los campos estan vacios - mostrar alertas', () => {
        
        cy.get('.auth__form-login').submit()
        .then(()=>{  
            cy.get('.alert').should('have.length', 1); // debe de mostrarse la alerta
        })
        
    });

    it('Si los campos estan completos - pero no existe el usuario', ()=>{

        cy.get('[type="email"]').type('correo@correo.com'); // email
        cy.get('[type="password"]').type('correo@correo.com'); // password
        
        cy.get('.auth__form-login').submit()  
        .then(()=>{  
            cy.get('.alert').should('have.length', 1); // debe de mostrarse la alerta
        })

    });

    it('Si los campos estan completos - Si existe el usuario', ()=>{

        cy.get('[type="email"]').type('martin@gmail.com'); // email
        cy.get('[type="password"]').type('martin1234'); // password    

        cy.get('.auth__form-login').submit()
        .then(()=>{  
            
            cy.get('.alert').should('not.have.length', 1); // no debe existir una alerta

            cy.visit('http://localhost:8080/upTask/dashboard/index'); // enviar a la pagina principal
        })

        cy.wait(2000);
        cy.go('back');

    });

});