/// <reference types="cypress" />

describe('upTask - Crear Cuenta', ()=>{

    beforeEach(()=> cy.visit('http://localhost:8080/upTask/user/create') );

    it('Revisar los elementos del formulario', () => {
        
        cy.get('.auth_input')
        .should('exist')
        .should('have.length', 4); // deben de existir dos inputs

        cy.get('[type="submit"]')
        .should('exist')
        .should('have.length', 1); // debe existir un boton de tipo submit

    });

    it('Revisar enlace para iniciar sesión - enviar a la pagina esperada', ()=>{

        cy.get('[data-cy="link_login"]')
        .should('exist')
        .should('have.length', 1); // debe existir un boton de tipo submit

        cy.get('[data-cy="link_login"]').click()
        .then(()=>{
            cy.visit('http://localhost:8080/upTask/auth/login'); // crear cuenta
        })
        
        cy.wait(2000);
        cy.go('back');

    });

    it('Revisar enlace de crear cuenta - enviar a la pagina esperada', ()=>{

        cy.get('[data-cy="link_forgett_pass"]')
        .should('exist')
        .should('have.length', 1); // debe existir un boton de tipo submit

        cy.get('[data-cy="link_forgett_pass"]').click()
        .then(()=>{
            cy.visit('http://localhost:8080/upTask/auth/forgett'); // crear cuenta
        })
        
        cy.wait(2000);
        cy.go('back');

    });

    it('Si los campos estan vacios - mostrar alertas', () => {
        
        cy.get('.auth__form-create')
        .should('exist')
        .should('have.length', 1); // debe existir el formulario

        cy.get('.auth__form-create').submit()
        .then(()=>{  
            cy.get('.alert').should('have.length', 1); // debe de mostrarse la alerta
        });
        
    });

    it('Si los campos estan completos - pero las contraseñas no son iguales', ()=>{

        cy.get('[name="nombre"]').type('test'); // nombre
        cy.get('[name="email"]').type('test@test.com'); // email
        cy.get('[name="password"]').type('test1234'); // password
        cy.get('[name="confirmPassword"]').type("test12345"); // confirmar password

        cy.get('.auth__form-create').submit()  
        .then(()=>{  
            cy.get('.alert').should('have.length', 1); // debe de mostrarse la alerta
        })

    });

    it('Si los campos estan completos - las contraseñas son correctas', ()=>{

        cy.get('[name="nombre"]').type('test'); // nombre
        let email = "";
        cy.get('[name="email"]')
        .type('test@test.com')
        .invoke('val')
        .then(text => email = text ); // email
        cy.get('[name="password"]').type('test1234'); // password
        cy.get('[name="confirmPassword"]').type("test1234"); // confirmar password

        cy.get('.auth__form-create').submit()  
        .then(()=>{  
            cy.get('.alert').should('not.have.length', 1); // no debe de existir la alerta
            cy.visit("http://localhost:8080/upTask/auth/message?email=" + email);
            
            cy.get('[data-cy="message"]')
            .should('exist')
            .invoke('text')
            .should('equal','Hemos enviado las instrucciones a tu email para continuar 📩'); // debe de existir un mensaje

        })

    });

});