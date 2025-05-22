/**
 * @file
 * @brief JS implementation of the menu injection builder for Chrome browser.
 */

// create namespace
if (!window.SkypeClick2Call)
{
  window.SkypeClick2Call = {};
}

if (!SkypeClick2Call.MenuInjectionBuilder)
{
  SkypeClick2Call.MenuInjectionBuilder = {};

  /* Initialized in C++ part
  SkypeClick2Call.MenuInjectionBuilder.CSS_MENU_MAIN_CONTAINER          = "skype_pnh_menu_container";
  SkypeClick2Call.MenuInjectionBuilder.CSS_MENU_CLICK_TO_CALL_CONTAINER = "skype_pnh_menu_click2call";
  SkypeClick2Call.MenuInjectionBuilder.CSS_MENU_CLICK_TO_CALL_ACTION    = "skype_pnh_menu_click2call_action";
  SkypeClick2Call.MenuInjectionBuilder.CSS_MENU_CLICK_TO_SMS_CONTAINER  = "skype_pnh_menu_click2sms";
  SkypeClick2Call.MenuInjectionBuilder.CSS_MENU_CLICK_TO_SMS_ACTION     = "skype_pnh_menu_click2sms_action";
  SkypeClick2Call.MenuInjectionBuilder.CSS_MENU_ADD_TO_SKYPE            = "skype_pnh_menu_add2skype";
  SkypeClick2Call.MenuInjectionBuilder.CSS_MENU_ADD_TO_SKYPE_LINK       = "skype_pnh_menu_add2skype_text";
  SkypeClick2Call.MenuInjectionBuilder.CSS_MENU_CALL_TOLL_INFO          = "skype_pnh_menu_toll_info";
  SkypeClick2Call.MenuInjectionBuilder.CSS_MENU_CALL_TOLL_INFO_CREDIT   = "skype_pnh_menu_toll_callcredit";
  SkypeClick2Call.MenuInjectionBuilder.CSS_MENU_CALL_TOLL_FREE          = "skype_pnh_menu_toll_free";
  SkypeClick2Call.MenuInjectionBuilder.CSS_MENU_MOBILE_ACTIVE           = "skype_pnh_mobile_active";
  SkypeClick2Call.MenuInjectionBuilder.CSS_MENU_FREE_CALL_ACTIVE        = "skype_pnh_free_active";
  */
}

/**
 * Create all menu components and add menu into the body.
 *
 * @param click2CallText         text for 'Click to call' action
 * @param click2SMSText          text for 'Click to SMS' action
 * @param addToSkypeText         text for 'Add to Skype'
 * @param callWithCreditText     text for 'Call with Skype credits'
 * @param freeText               text for 'Free call'
 *
 * @return result object containing references to the main menu components
 */
SkypeClick2Call.MenuInjectionBuilder.CreateInjectionElements = function(
                                                         click2CallText,
                                                         click2SMSText,
                                                         addToSkypeText,
                                                         callWithCreditText,
                                                         freeText)
{
  var result = {};
  try
  {
    // 1) Create the menu container
    var menuMainContainer = document.createElement('DIV');
    menuMainContainer.className = this.CSS_MENU_MAIN_CONTAINER;
    menuMainContainer.id = 'skype_pnh_menu_container';
    menuMainContainer.style.display = 'none';
    menuMainContainer.setAttribute(
                       'onmouseover',
                       'SkypeClick2Call.MenuInjectionHandler.showMenu(this, event)');
    menuMainContainer.setAttribute(
                       'onmouseout',
                       'SkypeClick2Call.MenuInjectionHandler.hideMenu(event)');

    // save created element
    result.mainContainer = menuMainContainer;

    // 2) Create container for Click to Call action
    var menuClick2CallContainer = document.createElement('DIV');
    menuClick2CallContainer.className = this.CSS_MENU_CLICK_TO_CALL_CONTAINER;

    // save created element
    result.clickToCallContainer = menuClick2CallContainer;

    // Append Click to call container into main container
    menuMainContainer.appendChild(menuClick2CallContainer);

    // 2a) Create Click to call action
    var menuClick2CallElement = document.createElement('A');
    menuClick2CallElement.className = this.CSS_MENU_CLICK_TO_CALL_ACTION;
    menuClick2CallElement.id = 'skype_pnh_menu_click2call_action';

    // Add action text
    menuClick2CallElement.appendChild(document.createTextNode(click2CallText));

    // Append into container
    menuClick2CallContainer.appendChild(menuClick2CallElement);

    // 3) Create container for Click to SMS action
    var menuClick2SMSContainer = document.createElement('DIV');
    menuClick2SMSContainer.className = this.CSS_MENU_CLICK_TO_SMS_CONTAINER;

    // save created element
    result.clickToSMSContainer = menuClick2SMSContainer;

    // Append Click to SMS container into main container
    menuMainContainer.appendChild(menuClick2SMSContainer);

    // 3a) Create Click to SMS action
    var menuClick2SMSElement = document.createElement('A');
    menuClick2SMSElement.className = this.CSS_MENU_CLICK_TO_SMS_ACTION;
    menuClick2SMSElement.id = 'skype_pnh_menu_click2sms_action';

    // Add action text
    menuClick2SMSElement.appendChild(document.createTextNode(click2SMSText));

    // Append into container
    menuClick2SMSContainer.appendChild(menuClick2SMSElement);
    
    // 4) Create container for Add to Skype
    var menuAddToSkypeContainer = document.createElement('DIV');
    menuAddToSkypeContainer.className = this.CSS_MENU_ADD_TO_SKYPE;

    // save created element
    result.addToSkypeContainer = menuAddToSkypeContainer;

    // Append Add to Skype container into main container
    menuMainContainer.appendChild(menuAddToSkypeContainer);

    // 4a) Create the Add to Skype link
    var menuAddToSkypeElement = document.createElement('A');
    menuAddToSkypeElement.className = this.CSS_MENU_ADD_TO_SKYPE_LINK;
    menuAddToSkypeElement.id = 'skype_pnh_menu_add2skype_text';

    // Add the Add to Skype text
    menuAddToSkypeElement.appendChild(document.createTextNode(addToSkypeText));

    // Append into container
    menuAddToSkypeContainer.appendChild(menuAddToSkypeElement);

    // 5) Create container for call toll status
    var menuTollInfoContainer = document.createElement('DIV');
    menuTollInfoContainer.className = this.CSS_MENU_CALL_TOLL_INFO;

    // save created element
    result.tollInfoContainer = menuTollInfoContainer;

    // Append toll info container into main container
    menuMainContainer.appendChild(menuTollInfoContainer);

    // 5a) Create span elements for all possible toll status
    var menuCallCreditElement = document.createElement('SPAN');
    menuCallCreditElement.className = this.CSS_MENU_CALL_TOLL_INFO_CREDIT;

    var menuCallFreeElement = document.createElement('SPAN');
    menuCallFreeElement.className = this.CSS_MENU_CALL_TOLL_FREE;

    // Add toll info texts into respective elements
    menuCallCreditElement.appendChild(
                                  document.createTextNode(callWithCreditText));
    menuCallFreeElement.appendChild(document.createTextNode(freeText));

    // Append into container
    menuTollInfoContainer.appendChild(menuCallCreditElement);
    menuTollInfoContainer.appendChild(menuCallFreeElement);

    // Append menu into body
    document.body.appendChild(menuMainContainer);
  }
  catch(e)
  {
    result = {};
  }

  return result;
};

/**
 * Remove a menu node.
 *
 * @param node  the node to be removed.
 */
SkypeClick2Call.MenuInjectionBuilder.RemoveElement = function(node)
{
  var parentNode = node.parentNode;
  parentNode.removeChild(node);
};

/**
 * Remove menu components.
 *
 * @param mainContainer          the main menu container
 * @param flagNumberContainer    holds country flag and phone number
 * @param clickToCallContainer   container of the click to call action
 * @param clickToSMSContainer    container of the click to SMS action
 * @param tollInfoContainer      holds call/SMS info
 * @param addToSkypeContainer    Add to Skype container
 * @param helpContainer          Help container
 */
SkypeClick2Call.MenuInjectionBuilder.DestroyInjectionElements = function(
                                                          mainContainer,
                                                          clickToCallContainer,
                                                          clickToSMSContainer,
                                                          addToSkypeContainer,
                                                          tollInfoContainer)
{
  try
  {
    if (mainContainer)
    {
      SkypeClick2Call.MenuInjectionBuilder.RemoveElement(mainContainer);
    }
    else
    {
      SkypeClick2Call.MenuInjectionBuilder.RemoveElement(clickToCallContainer);
      SkypeClick2Call.MenuInjectionBuilder.RemoveElement(clickToSMSContainer);
      SkypeClick2Call.MenuInjectionBuilder.RemoveElement(addToSkypeContainer);
      SkypeClick2Call.MenuInjectionBuilder.RemoveElement(tollInfoContainer);
    }
  }
  catch(e)
  {
    // Do nothing
  }
};

// create META to inform contentscript.js that this file is ready
document.head.appendChild(document.createElement('meta')).name = "menu_injection_builder.js";
