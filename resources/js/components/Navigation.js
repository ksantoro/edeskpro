import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import { Nav, Navbar } from 'react-bootstrap';
import styled from 'styled-components';

const Styles = styled.div`

.navbar {
    background-color: #00cccc;
}

.navbar-brand, .navbar-nav .nav-link {
    color: #fff;
    
    &:hover {
        color: #222;
    }
}
`;

export const Navigation = () => (
<Styles>
    <Navbar expand='lg'>
        <Navbar.Brand href='/'>eDeskPro</Navbar.Brand>
        <Navbar.Toggle area-controls='basic-navbar-nav'/>
        <Navbar.Collapse id='basic-navbar-nav'>
            <Nav className='ml-auto'>
                <Nav.Item><Nav.Link href='/'>Home</Nav.Link></Nav.Item>
                <Nav.Item><Nav.Link href='/login'>Login</Nav.Link></Nav.Item>
            </Nav>
        </Navbar.Collapse>
    </Navbar>
</Styles>
)

if (document.getElementById('navigation')) {
    ReactDOM.render(<Navigation />, document.getElementById('navigation'));
}
